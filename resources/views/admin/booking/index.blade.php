@extends('layouts.app')

@section('title', 'Bookings')

@section('content')
  <div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">
      <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Bookings</h5>
        <!-- Trigger Create Modal -->
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#createBookingModal">
          <i class="bi bi-plus-circle"></i> Add Booking
        </button>
      </div>

      <div class="card-body">
        @include('message')

        <div class="table-responsive">
          <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
            <tr>
              <th>#</th>
              <th>User</th>
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
                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                <td>
                  {{ $booking->schedule->route->originTerminal->name ?? 'N/A' }}
                  → {{ $booking->schedule->route->destinationTerminal->name ?? 'N/A' }}
                  <br>
                  {{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('d M Y - h:i A') }}
                </td>
                <td>
                  @foreach($booking->seats as $seat)
                    <span class="badge bg-secondary">{{ $seat->seat_number }}</span>
                  @endforeach
                </td>
                <td>${{ number_format($booking->total_amount, 2) }}</td>
                <td>
                  @switch($booking->status)
                    @case('confirmed')
                      <span class="badge bg-success">Confirmed</span>
                      @break
                    @case('pending')
                      <span class="badge bg-warning text-dark">Pending</span>
                      @break
                    @case('cancelled')
                      <span class="badge bg-danger">Cancelled</span>
                      @break
                    @default
                      <span class="badge bg-secondary">Unknown</span>
                  @endswitch
                </td>
                <td>
                  <!-- Edit Button -->
                  <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editBookingModal{{ $booking->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>

                  <!-- Delete Button -->
                  <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteBookingModal{{ $booking->id }}">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="7" class="text-muted">No bookings found</td>
              </tr>
            @endforelse
            </tbody>
          </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
          {{ $bookings->links() }}
        </div>
      </div>
    </div>
  </div>

  {{-- Include Modals --}}
  @include('admin.booking.modals.create')
  @include('admin.booking.modals.edit')
  @include('admin.booking.modals.delete')

@endsection
