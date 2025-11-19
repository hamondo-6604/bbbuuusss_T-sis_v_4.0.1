<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Bus;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BookingController extends Controller
{
  /**
   * Display a listing of the user's bookings.
   */
  public function index()
  {
    $bookings = Auth::user()->bookings()
      ->with(['bus', 'route'])
      ->latest()
      ->paginate(10);

    return view('passengers.bookings.index', compact('bookings'));
  }

  /**
   * Show the form for creating a new booking.
   */
  public function create()
  {
    $users = User::all();
    $buses = Bus::all();
    $routes = Route::all();

    return view('passengers.bookings.create', compact('buses', 'routes'));
  }

  /**
   * Store a newly created booking in storage.
   */
  public function store(Request $request)
  {
    $data = $request->validate([
      'bus_id' => 'required|exists:buses,id',
      'route_id' => 'required|exists:routes,id',
      'seat_number' => 'nullable|string',
      'seat_type' => 'required|string',
      'amount_paid' => 'required|numeric',
      'departure_time' => 'required|date',
      'arrival_time' => 'required|date|after_or_equal:departure_time',
    ]);

    $data['user_id'] = Auth::id();

    Booking::create($data);

    return redirect()->route('user.bookings.index')
      ->with('success', 'Booking created successfully!');
  }

  /**
   * Display the specified booking.
   */
  public function show(Booking $booking)
  {
    if ($booking->user_id !== Auth::id()) {
      return redirect()->route('user.bookings.index')
        ->with('error', 'You are not authorized to view this booking.');
    }

    $booking->load(['bus', 'route', 'trip']);

    return view('passengers.bookings.show', compact('booking'));
  }

  /**
   * Cancel the specified booking.
   */
  public function destroy(Booking $booking)
  {
    if ($booking->user_id !== Auth::id()) {
      return redirect()->route('user.bookings.index')
        ->with('error', 'Cannot cancel a booking you do not own.');
    }

    if (!in_array($booking->status, ['pending', 'confirmed'])) {
      return back()->with('error', 'This booking is not eligible for cancellation.');
    }

    $booking->update([
      'status' => 'cancelled',
      'cancelled_at' => now(),
      'payment_status' => 'refund_pending',
    ]);

    return redirect()->route('user.bookings.index')
      ->with('success', "Booking {$booking->booking_reference} has been cancelled.");
  }
}
