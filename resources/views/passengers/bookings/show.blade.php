@extends('layouts.app')

@section('content')
  <h1>Booking Details</h1>

  <p><strong>Booking Ref:</strong> {{ $booking->booking_reference }}</p>
  <p><strong>Bus:</strong> {{ $booking->bus->name ?? '-' }}</p>
  <p><strong>Route:</strong> {{ $booking->route->name ?? '-' }}</p>
  <p><strong>Seat:</strong> {{ $booking->seat_number }}</p>
  <p><strong>Status:</strong> {{ $booking->status }}</p>
  <p><strong>Amount Paid:</strong> {{ $booking->formatted_amount_paid }}</p>

  <a href="{{ route('user.bookings.index') }}">Back to bookings</a>
@endsection
