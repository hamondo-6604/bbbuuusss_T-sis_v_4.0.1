@extends('layouts.app')

@section('content')
  <h1>Edit Booking</h1>

  <form action="{{ route('user.bookings.update', $booking) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Status:</label>
    <select name="status">
      <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
      <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
      <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
      <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
    <br><br>

    <button type="submit">Update Booking</button>
  </form>

  <a href="{{ route('user.bookings.index') }}">Back to bookings</a>
@endsection
