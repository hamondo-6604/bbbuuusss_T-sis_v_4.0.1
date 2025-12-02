@foreach($bookings as $booking)
<div class="modal fade" id="editBookingModal{{ $booking->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title fw-bold">Edit Booking</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <div class="row g-3">

            <!-- User -->
            <div class="col-md-6">
              <label class="form-label">User <span class="text-danger">*</span></label>
              <select name="user_id" class="form-select" required>
                @foreach($users as $user)
                  <option value="{{ $user->id }}"
                    {{ $booking->user_id == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Schedule -->
            <div class="col-md-6">
              <label class="form-label">Schedule <span class="text-danger">*</span></label>
              <select name="schedule_id" class="form-select" required>
                @foreach($schedules as $schedule)
                  <option value="{{ $schedule->id }}"
                    {{ $booking->schedule_id == $schedule->id ? 'selected' : '' }}>
                    {{ $schedule->route->originTerminal->name }} →
                    {{ $schedule->route->destinationTerminal->name }}
                    ({{ \Carbon\Carbon::parse($schedule->departure_time)->format('d M Y - h:i A') }})
                  </option>
                @endforeach
              </select>
            </div>

            <!-- Seats -->
            <div class="col-12">
              <label class="form-label">Seats</label>
              <div class="border p-2 rounded" style="max-height: 160px; overflow-y:auto;">
                @foreach($seats as $seat)
                  <div class="form-check form-check-inline">
                    <input class="form-check-input"
                           type="checkbox"
                           name="seats[]"
                           value="{{ $seat->id }}"
                           {{ in_array($seat->id, $booking->seats->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $seat->seat_number }}</label>
                  </div>
                @endforeach
              </div>
            </div>

            <!-- Total Amount -->
            <div class="col-md-6">
              <label class="form-label">Total Amount <span class="text-danger">*</span></label>
              <input type="number" step="0.01" name="total_amount"
                     class="form-control"
                     value="{{ $booking->total_amount }}" required>
            </div>

            <!-- Status -->
            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select name="status" class="form-select">
                <option value="pending"    {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed"  {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled"  {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
              </select>
            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Booking</button>
        </div>

      </form>

    </div>
  </div>
</div>
@endforeach
