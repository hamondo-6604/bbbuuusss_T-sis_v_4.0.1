@foreach($bookings as $booking)
<div class="modal fade" id="deleteBookingModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title">Delete Booking</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body text-center">
          <p class="fw-bold">Are you sure you want to delete this booking?</p>
          <p class="text-muted mb-0">
            <strong>User:</strong> {{ $booking->user->name ?? 'N/A' }}<br>
            <strong>Schedule:</strong>
            {{ $booking->schedule->route->originTerminal->name ?? 'N/A' }}
            → {{ $booking->schedule->route->destinationTerminal->name ?? 'N/A' }}<br>
            <strong>Seats:</strong>
            @foreach($booking->seats as $seat)
              <span class="badge bg-secondary">{{ $seat->seat_number }}</span>
            @endforeach
          </p>
        </div>

        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>

      </form>

    </div>
  </div>
</div>
@endforeach
