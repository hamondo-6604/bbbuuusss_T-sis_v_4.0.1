@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Booking Details</h1>

    <div class="bg-white border p-4 rounded shadow">
        <p><strong>Booking Reference:</strong> {{ $booking->booking_reference }}</p>
        <p><strong>User:</strong> {{ $booking->user->name ?? '-' }}</p>
        <p><strong>Bus:</strong> {{ $booking->bus->name ?? '-' }}</p>
        <p><strong>Seat:</strong> {{ $booking->seat_number ?? '-' }} ({{ $booking->seat_type }})</p>
        <p><strong>Status:</strong> <span class="capitalize">{{ $booking->status }}</span></p>
        <p><strong>Amount Paid:</strong> ${{ $booking->amount_paid }}</p>
        <p><strong>Payment Status:</strong> {{ $booking->payment_status }}</p>
        <p><strong>Departure:</strong> {{ $booking->departure_time?->format('d M Y, H:i') ?? '-' }}</p>
        <p><strong>Arrival:</strong> {{ $booking->arrival_time?->format('d M Y, H:i') ?? '-' }}</p>
        <p><strong>Cancelled At:</strong> {{ $booking->cancelled_at?->format('d M Y, H:i') ?? '-' }}</p>
    </div>

    <div class="mt-4 space-x-2">
        <a href="{{ route('admin.bookings.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
    </div>
</div>
@endsection
