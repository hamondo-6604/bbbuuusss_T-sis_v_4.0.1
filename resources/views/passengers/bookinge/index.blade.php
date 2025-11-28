@extends('layouts.app')

@section('content')
  <h1>Your Bookings</h1>

  @if($bookings->count())
    <table border="1" cellpadding="5">
      <thead>
      <tr>
        <th>Booking Ref</th>
        <th>Bus</th>
        <th>Route</th>
        <th>Seat</th>
        <th>Status</th>
        <th>Amount Paid</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
      @foreach($bookings as $booking)
        <tr>
          <td>{{ $booking->booking_reference }}</td>
          <td>{{ $booking->bus->name ?? '-' }}</td>
          <td>{{ $booking->route->name ?? '-' }}</td>
          <td>{{ $booking->seat_number }}</td>
          <td>{{ $booking->status }}</td>
          <td>{{ $booking->formatted_amount_paid }}</td>
          <td>
            <a href="{{ route('user.bookings.show', $booking) }}">View</a> |
            <a href="{{ route('user.bookings.edit', $booking) }}">Edit</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>

    {{ $bookings->links() }} {{-- Pagination --}}
  @else
    <p>No bookings found.</p>
  @endif
@endsection
