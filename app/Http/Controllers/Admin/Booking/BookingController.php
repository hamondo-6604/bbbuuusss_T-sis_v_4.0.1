<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    // List all bookings
    public function index()
    {
        $bookings = Booking::latest()->paginate(20);
        return view('admin.booking_management.booking.index', compact('bookings'));
    }

    // Show form to create a booking
    public function create()
    {
        return view('admin.booking_management.booking.create');
    }

    // Store new booking
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|exists:users,id',
            'bus_id' => 'required|exists:buses,id',
            'seat_number' => 'nullable|string',
            'seat_type' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'departure_time' => 'nullable|date',
            'arrival_time' => 'nullable|date',
            'amount_paid' => 'nullable|numeric',
            'payment_status' => 'nullable|string',
        ]);

        Booking::create($data);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking created successfully.');
    }

    // Show single booking
    public function show(Booking $booking)
    {
        return view('admin.booking_management.booking.show', compact('booking'));
    }

    // Show form to edit booking
    public function edit(Booking $booking)
    {
        return view('admin.booking_management.booking.edit', compact('booking'));
    }

    // Update booking
    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'seat_number' => 'nullable|string',
            'seat_type' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled,completed',
            'departure_time' => 'nullable|date',
            'arrival_time' => 'nullable|date',
            'amount_paid' => 'nullable|numeric',
            'payment_status' => 'nullable|string',
        ]);

        $booking->update($data);

        return redirect()->route('admin.bookings.index')->with('success', 'Booking updated successfully.');
    }

    // Delete booking
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking deleted successfully.');
    }

    // Status views
    public function pending()
    {
        $pendingBookings = Booking::where('status', 'pending')->latest()->paginate(20);
        return view('admin.booking_management.status.pending', compact('pendingBookings'));
    }

    public function completed()
    {
        $completedBookings = Booking::where('status', 'completed')->latest()->paginate(20);
        return view('admin.booking_management.status.completed', compact('completedBookings'));
    }

    public function cancelled()
    {
        $cancelledBookings = Booking::where('status', 'cancelled')->latest()->paginate(20);
        return view('admin.booking_management.status.cancelled', compact('cancelledBookings'));
    }


    // Notifications placeholder
    public function notifications()
    {
        // Implement logic to list or resend booking notifications
        return view('admin.booking_management.booking.notifications');
    }
}
