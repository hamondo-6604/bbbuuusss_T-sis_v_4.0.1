@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')
  <div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Booking Details</h5>
        <a href="{{ route('user.bookings.index') }}" class="btn btn-sm btn-secondary">Back to Bookings</a>
      </div>

      <div class="card-body">
        @include('message')

        <div class="mb-3">
          <h6>Booking Information</h6>
          <ul class="list-group">
            <li class="list-group-item"><strong>Booking ID:</strong> {{ $booking->id }}</li>
            <li class="list-group-item">
              <strong>Schedule:</strong>
              {{ $booking->schedule->route->originTerminal->name ?? 'N/A' }}
              → {{ $booking->schedule->route->destinationTerminal->name ?? 'N/A' }}
              <br>
              <strong>Departure:</strong> {{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('d M Y - h:i A') }}
            </li>
            <li class="list-group-item">
              <strong>Seats:</strong>
              @foreach($booking->seats as $seat)
                <span class="badge bg-secondary">{{ $seat->seat->seat_number ?? 'N/A' }}</span>
              @endforeach
            </li>
            <li class="list-group-item"><strong>Total Amount:</strong> ${{ number_format($booking->total_amount, 2) }}</li>
            <li class="list-group-item">
              <strong>Status:</strong>
              @if($booking->status=='confirmed')
                <span class="badge bg-success">Confirmed</span>
              @elseif($booking->status=='pending')
                <span class="badge bg-warning text-dark">Pending</span>
              @else
                <span class="badge bg-danger">Cancelled</span>
              @endif
            </li>
          </ul>
        </div>

        <div class="mt-3">
          @if($booking->status != 'cancelled')
            <!-- Cancel Button -->
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelBookingModal{{ $booking->id }}">
              Cancel Booking
            </button>
          @endif
        </div>
      </div>
    </div>
  </div>

  <!-- Include Cancel Modal -->
  @include('passenger.bookings.modals.cancel', ['booking' => $booking])
@endsection
