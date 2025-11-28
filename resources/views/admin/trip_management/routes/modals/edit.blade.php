<!-- resources/views/admin/trip_management/routes/modals/edit.blade.php -->
@foreach($routes as $route)
  <div class="modal fade" id="editRouteModal{{ $route->id }}" tabindex="-1" aria-labelledby="editRouteModalLabel{{ $route->id }}" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('admin.routes.update', $route->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="editRouteModalLabel{{ $route->id }}">Edit Route</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="origin_terminal_id{{ $route->id }}" class="form-label">Origin Terminal</label>
              <select name="origin_terminal_id" id="origin_terminal_id{{ $route->id }}" class="form-select" required>
                <option value="">Select Origin Terminal</option>
                @foreach($terminals as $terminal)
                  <option value="{{ $terminal->id }}" {{ $route->origin_terminal_id == $terminal->id ? 'selected' : '' }}>
                    {{ $terminal->name }} ({{ $terminal->city->name }})
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="destination_terminal_id{{ $route->id }}" class="form-label">Destination Terminal</label>
              <select name="destination_terminal_id" id="destination_terminal_id{{ $route->id }}" class="form-select" required>
                <option value="">Select Destination Terminal</option>
                @foreach($terminals as $terminal)
                  <option value="{{ $terminal->id }}" {{ $route->destination_terminal_id == $terminal->id ? 'selected' : '' }}>
                    {{ $terminal->name }} ({{ $terminal->city->name }})
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="via{{ $route->id }}" class="form-label">Via (optional)</label>
              <input type="text" name="via" id="via{{ $route->id }}" class="form-control" value="{{ $route->via }}">
            </div>

            <div class="mb-3">
              <label for="distance_km{{ $route->id }}" class="form-label">Distance (km)</label>
              <input type="number" step="0.01" name="distance_km" id="distance_km{{ $route->id }}" class="form-control" value="{{ $route->distance_km }}" required>
            </div>

            <div class="mb-3">
              <label for="duration_min{{ $route->id }}" class="form-label">Duration (minutes)</label>
              <input type="number" name="duration_min" id="duration_min{{ $route->id }}" class="form-control" value="{{ $route->duration_min }}" required>
            </div>

            <div class="form-check mb-3">
              <input type="checkbox" name="is_active" id="is_active{{ $route->id }}" class="form-check-input" {{ $route->is_active ? 'checked' : '' }}>
              <label for="is_active{{ $route->id }}" class="form-check-label">Active</label>
            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Route</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
