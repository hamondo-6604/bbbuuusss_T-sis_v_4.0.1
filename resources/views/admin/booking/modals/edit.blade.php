<!-- resources/views/admin/booking/modals/edit.blade.php -->
@foreach($bookings as $booking)
  <div class="modal fade" id="editBookingModal{{ $booking->id }}" tabindex="-1" aria-labelledby="editBookingModalLabel{{ $booking->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="editBookingModalLabel{{ $booking->id }}">Edit Booking</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="status{{ $booking->id }}" class="form-label">Status</label>
              <select name="status" id="status{{ $booking->id }}" class="form-select">
                <option value="confirmed" {{ $booking->status=='confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="pending" {{ $booking->status=='pending' ? 'selected' : '' }}>Pending</option>
                <option value="cancelled" {{ $booking->status=='cancelled' ? 'selected' : '' }}>Cancelled</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
