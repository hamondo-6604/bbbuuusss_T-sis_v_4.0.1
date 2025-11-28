<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
  /**
   * Display a listing of the user's bookings.
   */
  public function index()
  {
    $bookings = Booking::with(['schedule.route', 'schedule.bus', 'seats.seatType'])
      ->where('user_id', auth()->id())
      ->latest()
      ->paginate(10);

    return view('passengers.bookings.index', compact('bookings'));
  }

  /**
   * Display the specified booking details.
   */
  public function show(Booking $booking)
  {
    // Ensure the booking belongs to the logged-in user
    if ($booking->user_id !== auth()->id()) {
      abort(403, 'Unauthorized access.');
    }

    $booking->load(['schedule.route.originTerminal', 'schedule.route.destinationTerminal', 'schedule.bus', 'seats.seatType']);

    return view('passengers.bookings.show', compact('booking'));
  }

  /**
   * Cancel the specified booking.
   */
  public function cancel(Booking $booking)
  {
    // Ensure the booking belongs to the logged-in user
    if ($booking->user_id !== auth()->id()) {
      abort(403, 'Unauthorized action.');
    }

    if ($booking->status === 'cancelled') {
      return redirect()->route('user.bookings.index')->with('info', 'Booking is already cancelled.');
    }

    DB::transaction(function () use ($booking) {
      // Update booking status
      $booking->status = 'cancelled';
      $booking->save();

      // Update all associated booking seats to cancelled
      $booking->seats()->update(['status' => 'cancelled']);
    });

    return redirect()->route('user.bookings.index')->with('success', 'Booking cancelled successfully.');
  }
}
