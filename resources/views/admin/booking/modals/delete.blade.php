<!-- resources/views/admin/booking/modals/delete.blade.php -->
@foreach($bookings as $booking)
  <div class="modal fade" id="deleteBookingModal{{ $booking->id }}" tabindex="-1" aria-labelledby="deleteBookingModalLabel{{ $booking->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-header">
            <h5 class="modal-title" id="deleteBookingModalLabel{{ $booking->id }}">Delete Booking</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            Are you sure you want to delete this booking?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
