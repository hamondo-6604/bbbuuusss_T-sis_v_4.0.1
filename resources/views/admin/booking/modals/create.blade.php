<!-- resources/views/admin/booking/modals/create.blade.php -->
<div class="modal fade" id="createBookingModal" tabindex="-1" aria-labelledby="createBookingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.bookings.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createBookingModalLabel">Create Booking</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select name="user_id" id="user_id" class="form-select">
              @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->full_name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="schedule_id" class="form-label">Schedule</label>
            <select name="schedule_id" id="schedule_id" class="form-select">
              @foreach($schedules as $schedule)
                <option value="{{ $schedule->id }}">
                  {{ $schedule->route->originTerminal->name }} → {{ $schedule->route->destinationTerminal->name }}
                  ({{ \Carbon\Carbon::parse($schedule->departure_time)->format('d M Y - h:i A') }})
                </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
              <option value="confirmed">Confirmed</option>
              <option value="pending">Pending</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Booking</button>
        </div>
      </form>
    </div>
  </div>
</div>
