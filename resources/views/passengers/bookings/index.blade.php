@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')
  <div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">My Bookings</h5>
      </div>

      <div class="card-body">
        @include('message')

        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>Schedule</th>
              <th>Seats</th>
              <th>Total Amount</th>
              <th>Status</th>
              <th style="width:120px;">Actions</th>
            </tr>
            </thead>
            <tbody>
            @forelse($bookings as $booking)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                  {{ $booking->schedule->route->originTerminal->name ?? 'N/A' }}
                  → {{ $booking->schedule->route->destinationTerminal->name ?? 'N/A' }}
                  <br>
                  {{ optional($booking->schedule->departure_time)->format('d M Y - h:i A') ?? 'N/A' }}
                </td>
                <td>
                  @foreach($booking->seats as $bookingSeat)
                    <span class="badge bg-secondary">{{ $bookingSeat->seat->seat_number ?? 'N/A' }}</span>
                  @endforeach
                </td>
                <td>${{ number_format($booking->total_amount, 2) }}</td>
                <td>
                  @if($booking->status=='confirmed')
                    <span class="badge bg-success">Confirmed</span>
                  @elseif($booking->status=='pending')
                    <span class="badge bg-warning text-dark">Pending</span>
                  @else
                    <span class="badge bg-danger">Cancelled</span>
                  @endif
                </td>
                <td>
                  @if($booking->status != 'cancelled')
                    <!-- Cancel Button -->
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#cancelBookingModal{{ $booking->id }}">
                      <i class="bi bi-x-circle"></i>
                    </button>
                  @else
                    <span class="text-muted">N/A</span>
                  @endif
                </td>
              </tr>

              <!-- Cancel Booking Modal -->
              @include('passengers.bookings.modals.cancel', ['booking' => $booking])

            @empty
              <tr>
                <td colspan="6" class="text-center text-muted">No bookings found.</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        <div class="mt-3">
          {{ $bookings->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection
