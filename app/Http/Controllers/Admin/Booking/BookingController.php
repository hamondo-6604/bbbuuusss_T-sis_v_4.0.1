<?php

namespace App\Http\Controllers\Admin\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Seat;
use App\Models\BookingSeat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings.
     */
    public function index()
    {
        $bookings = Booking::with([
            'user',
            'schedule.route.originTerminal',
            'schedule.route.destinationTerminal',
            'seats.seatType'
        ])->latest()->paginate(10);

        $users = User::where('status', 'active')->get();
        $schedules = Schedule::with(['route.originTerminal', 'route.destinationTerminal', 'bus'])
                             ->where('status', 'active')->get();
        $seats = Seat::with('seatType')->where('status', 'active')->get();

        return view('admin.booking.index', compact('bookings', 'users', 'schedules', 'seats'));
    }

    /**
     * Show the form for creating a new booking.
     */
    public function create()
    {
        $users = User::where('status', 'active')->get();
        $schedules = Schedule::with(['route.originTerminal', 'route.destinationTerminal', 'bus'])
                             ->where('status', 'active')->get();
        $seats = Seat::with('seatType')->where('status', 'active')->get();

        return view('admin.booking.modals.create', compact('users', 'schedules', 'seats'));
    }

    /**
     * Store a newly created booking in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'seats' => 'required|array|min:1',
            'seats.*' => 'exists:seats,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        DB::transaction(function() use ($request) {
            // Create booking with UUID
            $booking = Booking::create([
                'id' => Str::uuid(),
                'user_id' => $request->user_id,
                'schedule_id' => $request->schedule_id,
                'booking_date' => now(),
                'total_amount' => $request->total_amount,
                'status' => $request->status,
            ]);

            // Attach seats with pivot
            foreach ($request->seats as $seatId) {
                BookingSeat::create([
                    'booking_id' => $booking->id,
                    'seat_id' => $seatId,
                    'status' => 'booked'
                ]);
            }
        });

        return redirect()->route('admin.bookings.index')
                         ->with('success', 'Booking created successfully.');
    }

    /**
     * Show the form for editing a booking.
     */
    public function edit($id)
    {
        $booking = Booking::with('seats')->findOrFail($id);
        $users = User::where('status', 'active')->get();
        $schedules = Schedule::with(['route.originTerminal', 'route.destinationTerminal', 'bus'])
                             ->where('status', 'active')->get();
        $seats = Seat::with('seatType')->where('status', 'active')->get();

        return view('admin.booking.modals.edit', compact('booking', 'users', 'schedules', 'seats'));
    }

    /**
     * Update a booking in storage.
     */
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'schedule_id' => 'required|exists:schedules,id',
            'seats' => 'required|array|min:1',
            'seats.*' => 'exists:seats,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        DB::transaction(function() use ($request, $booking) {
            // Update booking details
            $booking->update([
                'user_id' => $request->user_id,
                'schedule_id' => $request->schedule_id,
                'total_amount' => $request->total_amount,
                'status' => $request->status,
            ]);

            // Sync seats (attach/detach automatically)
            $booking->seats()->sync($request->seats);
        });

        return redirect()->route('admin.bookings.index')
                         ->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove a booking from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);

        DB::transaction(function() use ($booking) {
            // Detach seats
            $booking->seats()->detach();
            // Delete booking
            $booking->delete();
        });

        return redirect()->route('admin.bookings.index')
                         ->with('success', 'Booking deleted successfully.');
    }

    /**
     * Show booking details (optional modal).
     */
    public function show($id)
    {
        $booking = Booking::with([
            'user',
            'schedule.route.originTerminal',
            'schedule.route.destinationTerminal',
            'seats.seatType'
        ])->findOrFail($id);

        return view('admin.booking.modals.show', compact('booking'));
    }
}
