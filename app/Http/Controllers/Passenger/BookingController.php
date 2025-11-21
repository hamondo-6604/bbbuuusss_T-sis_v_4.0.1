<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\BusRoute;
use App\Models\Trip;
use App\Models\Booking;
use App\Models\SeatLayout;

class BookingController extends Controller
{
  // STEP 1 — Show Route + Date Selection Form
  public function create()
  {
    $routes = BusRoute::select('origin', 'destination')->distinct()->get();

    // Extract unique origins and destinations
    $origins = $routes->pluck('origin')->unique();
    $destinations = $routes->pluck('destination')->unique();

    return view('passengers.bookings.create', compact('origins', 'destinations'));
  }


  // STEP 1 (POST) — Save selected route + date & redirect to trips page
  public function storeRouteDate(Request $request)
  {
    $request->validate([
      'origin'      => 'required|string',
      'destination' => 'required|string|different:origin',
      'travel_date' => 'required|date|after_or_equal:today',
    ]);

    return redirect()->route(
      'user.bookings.selectTrip',
      [
        'from' => $request->origin,
        'to'   => $request->destination,
        'date' => $request->travel_date,
      ]
    );
  }

  // STEP 2 — Show available trips for selected route
  public function selectTrip($from, $to, $date)
  {
    $travelDate = Carbon::parse($date);

    $trips = Trip::whereHas('route', function ($q) use ($from, $to) {
      $q->where('origin', $from)->where('destination', $to);
    })
      ->whereDate('departure_time', $travelDate)
      ->with(['bus', 'route', 'bus.seatLayout'])
      ->get();

    $upcomingTrips = collect();
    if ($trips->isEmpty()) {
      $upcomingTrips = Trip::whereHas('route', function ($q) use ($from, $to) {
        $q->where('origin', $from)->where('destination', $to);
      })
        ->whereDate('departure_time', '>', $travelDate)
        ->orderBy('departure_time', 'asc')
        ->with(['bus', 'route', 'bus.seatLayout'])
        ->get();
    }

    return view('passengers.bookings.select-trip', [
      'trips' => $trips,
      'upcomingTrips' => $upcomingTrips,
      'selectedDate' => $travelDate->format('Y-m-d'),
      'from' => $from,
      'to' => $to,
    ]);
  }

  // STEP 3 — Seat Selection
  public function selectSeats(Trip $trip)
  {
    $bus = $trip->bus;
    $layout = $bus->seatLayout;

    $seats = [];

    if ($layout && $layout->layout_map) {
      $rows = $layout->layout_map['rows'];
      $columns = $layout->layout_map['columns'];

      for ($r = 1; $r <= $rows; $r++) {
        for ($c = 1; $c <= $columns; $c++) {
          $seatNumber = $r . chr(64 + $c); // e.g., 1A, 1B, 2A, 2B
          $seats[] = [
            'seat_number' => $seatNumber,
            'available'   => !$trip->bookings()->where('seat_number', $seatNumber)->exists(),
            'type'        => 'economy', // you can customize based on layout
          ];
        }
      }
    }

    return view('passengers.bookings.seats', compact('trip', 'seats'));
  }


  // STEP 4 — Confirm Booking
  public function confirm(Request $request, Trip $trip)
  {
    $request->validate([
      'seat_number' => 'required|string',
    ]);

    // Prevent double booking
    if (Booking::where('trip_id', $trip->id)->where('seat_number', $request->seat_number)->exists()) {
      return back()->with('error', 'This seat has just been booked. Please choose another.');
    }

    $bookingData = [
      'travel_date' => $trip->departure_time->format('Y-m-d'),
      'fare' => $trip->fare ?? 0,
    ];

    return view('passengers.bookings.confirm', [
      'trip' => $trip,
      'seatNumber' => $request->seat_number,
      'bookingData' => $bookingData,
    ]);
  }

  // FINAL — Store booking
  public function storeFinal(Request $request, Trip $trip)
  {
    $request->validate([
      'seat_number' => 'required|string',
      'travel_date' => 'required|date',
    ]);

    if (Booking::where('trip_id', $trip->id)->where('seat_number', $request->seat_number)->exists()) {
      return redirect()->route('user.bookings.create')
        ->with('error', 'Seat already booked. Please start again.');
    }

    $booking = Booking::create([
      'user_id' => Auth::id(),
      'bus_id' => $trip->bus_id,
      'route_id' => $trip->route_id,
      'trip_id' => $trip->id,
      'seat_number' => $request->seat_number,
      'seat_type' => 'economy', // Optional: could fetch from layout_map
      'departure_time' => $trip->departure_time,
      'arrival_time' => $trip->arrival_time,
      'amount_paid' => $trip->fare,
      'payment_status' => 'unpaid',
      'status' => 'pending',
      'booking_reference' => $this->generateReference(),
    ]);

    return redirect()->route('user.bookings.index')
      ->with('success', 'Booking successfully created!');
  }

  private function generateReference()
  {
    return 'BKG-' . strtoupper(Str::random(8));
  }

  public function index()
  {
    $bookings = Booking::where('user_id', Auth::id())
      ->latest()
      ->paginate(10);

    return view('passengers.bookings.index', compact('bookings'));
  }
}
