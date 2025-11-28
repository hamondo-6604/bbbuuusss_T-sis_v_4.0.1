<!-- resources/views/admin/trip_management/routes/modals/create.blade.php -->
<div class="modal fade" id="createRouteModal" tabindex="-1" aria-labelledby="createRouteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.routes.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createRouteModalLabel">Add Route</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="origin_terminal_id" class="form-label">Origin Terminal</label>
            <select name="origin_terminal_id" id="origin_terminal_id" class="form-select" required>
              <option value="">Select Origin Terminal</option>
              @foreach($terminals as $terminal)
                <option value="{{ $terminal->id }}">{{ $terminal->name }} ({{ $terminal->city->name }})</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="destination_terminal_id" class="form-label">Destination Terminal</label>
            <select name="destination_terminal_id" id="destination_terminal_id" class="form-select" required>
              <option value="">Select Destination Terminal</option>
              @foreach($terminals as $terminal)
                <option value="{{ $terminal->id }}">{{ $terminal->name }} ({{ $terminal->city->name }})</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="via" class="form-label">Via (optional)</label>
            <input type="text" name="via" id="via" class="form-control">
          </div>

          <div class="mb-3">
            <label for="distance_km" class="form-label">Distance (km)</label>
            <input type="number" step="0.01" name="distance_km" id="distance_km" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="duration_min" class="form-label">Duration (minutes)</label>
            <input type="number" name="duration_min" id="duration_min" class="form-control" required>
          </div>

          <div class="form-check mb-3">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" checked>
            <label for="is_active" class="form-check-label">Active</label>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Route</button>
        </div>
      </form>
    </div>
  </div>
</div>
