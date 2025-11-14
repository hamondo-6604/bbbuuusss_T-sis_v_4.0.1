@extends('layouts.app')

@section('title', 'All Bookings')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Bookings</h1>
        <a href="{{ route('admin.bookings.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Booking</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <table class="min-w-full border border-gray-200 rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 border">#</th>
                <th class="px-4 py-2 border">Booking Ref</th>
                <th class="px-4 py-2 border">User</th>
                <th class="px-4 py-2 border">Bus</th>
                <th class="px-4 py-2 border">Seat</th>
                <th class="px-4 py-2 border">Status</th>
                <th class="px-4 py-2 border">Amount Paid</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $booking)
            <tr>
                <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
                <td class="px-4 py-2 border">{{ $booking->booking_reference }}</td>
                <td class="px-4 py-2 border">{{ $booking->user->name ?? '-' }}</td>
                <td class="px-4 py-2 border">{{ $booking->bus->name ?? '-' }}</td>
                <td class="px-4 py-2 border">{{ $booking->seat_number ?? '-' }}</td>
                <td class="px-4 py-2 border capitalize">{{ $booking->status }}</td>
                <td class="px-4 py-2 border">${{ $booking->amount_paid }}</td>
                <td class="px-4 py-2 border space-x-2">
                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="text-blue-500 hover:underline">View</a>
                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="text-yellow-500 hover:underline">Edit</a>
                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-4 py-2 border text-center">No bookings found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $bookings->links() }}
    </div>
</div>
@endsection
