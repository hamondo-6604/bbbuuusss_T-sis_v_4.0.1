<!-- Cancel Booking Modal -->
<div class="modal fade" id="cancelBookingModal{{ $booking->id }}" tabindex="-1" aria-labelledby="cancelBookingModalLabel{{ $booking->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="cancelBookingModalLabel{{ $booking->id }}">Cancel Booking</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to cancel this booking?</p>
        <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
        <p>
          <strong>Schedule:</strong>
          {{ $booking->schedule->route->originTerminal->name ?? 'N/A' }}
          → {{ $booking->schedule->route->destinationTerminal->name ?? 'N/A' }}
          <br>
          <strong>Departure:</strong> {{ \Carbon\Carbon::parse($booking->schedule->departure_time)->format('d M Y - h:i A') }}
        </p>
        <p>
          <strong>Seats:</strong>
          @foreach($booking->seats as $seat)
            <span class="badge bg-secondary">{{ $seat->seat->seat_number ?? 'N/A' }}</span>
          @endforeach
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form method="POST" action="{{ route('user.bookings.cancel', $booking->id) }}">
          @csrf
          <button type="submit" class="btn btn-danger">Yes, Cancel Booking</button>
        </form>
      </div>
    </div>
  </div>
</div>
