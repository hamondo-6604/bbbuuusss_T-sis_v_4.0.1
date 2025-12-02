<div class="modal fade" id="createBookingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <form action="{{ route('admin.bookings.store') }}" method="POST">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title fw-bold">Add New Booking</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

          <div class="row g-3">

            <!-- User -->
            <div class="col-md-6">
              <label class="form-label">User <span class="text-danger">*</span></label>
              <select name="user_id" class="form-select @error('user_id') is-invalid @enderror" required>
                <option value="">Select User</option>
                @foreach($users as $user)
                  <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                  </option>
                @endforeach
              </select>
              @error('user_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Schedule -->
            <div class="col-md-6">
              <label class="form-label">Schedule <span class="text-danger">*</span></label>
              <select name="schedule_id" class="form-select @error('schedule_id') is-invalid @enderror" required>
                <option value="">Select Schedule</option>
                @foreach($schedules as $schedule)
                  <option value="{{ $schedule->id }}" {{ old('schedule_id') == $schedule->id ? 'selected' : '' }}>
                    {{ $schedule->route->originTerminal->name ?? 'N/A' }}
                    → {{ $schedule->route->destinationTerminal->name ?? 'N/A' }}
                    ({{ \Carbon\Carbon::parse($schedule->departure_time)->format('d M Y - h:i A') }})
                  </option>
                @endforeach
              </select>
              @error('schedule_id')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
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
                           {{ (is_array(old('seats')) && in_array($seat->id, old('seats'))) ? 'checked' : '' }}>
                    <label class="form-check-label">{{ $seat->seat_number }}</label>
                  </div>
                @endforeach
              </div>
              @error('seats')
                <div class="text-danger small mt-1">{{ $message }}</div>
              @enderror
            </div>

            <!-- Total Amount -->
            <div class="col-md-6">
              <label class="form-label">Total Amount <span class="text-danger">*</span></label>
              <input type="number" step="0.01" name="total_amount"
                     class="form-control @error('total_amount') is-invalid @enderror"
                     value="{{ old('total_amount') }}" required>
              @error('total_amount')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Status -->
            <div class="col-md-6">
              <label class="form-label">Status</label>
              <select name="status" class="form-select">
                <option value="pending"    {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed"  {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled"  {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
              </select>
            </div>

          </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Booking</button>
        </div>

      </form>

    </div>
  </div>
</div>
