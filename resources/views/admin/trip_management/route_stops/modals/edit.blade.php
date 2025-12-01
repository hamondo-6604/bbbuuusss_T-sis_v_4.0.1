<!-- Edit Route Stop Modal -->
@foreach($routeStops as $stop)
  <div class="modal fade" id="editRouteStopModal{{ $stop->id }}" tabindex="-1" aria-labelledby="editRouteStopModalLabel{{ $stop->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('admin.route-stops.update', $stop->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="editRouteStopModalLabel{{ $stop->id }}">Edit Route Stop</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="route_id{{ $stop->id }}" class="form-label">Route</label>
              <select name="route_id" id="route_id{{ $stop->id }}" class="form-select">
                @foreach($routes as $route)
                  <option value="{{ $route->id }}" {{ $stop->route_id == $route->id ? 'selected' : '' }}>
                    {{ $route->originTerminal->name }} → {{ $route->destinationTerminal->name }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="stop_id{{ $stop->id }}" class="form-label">Stop</label>
              <select name="stop_id" id="stop_id{{ $stop->id }}" class="form-select">
                @foreach($stops as $s)
                  <option value="{{ $s->id }}" {{ $stop->stop_id == $s->id ? 'selected' : '' }}>
                    {{ $s->name }} ({{ $s->city->name ?? '-' }})
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="stop_order{{ $stop->id }}" class="form-label">Stop Order</label>
              <input type="number" name="stop_order" id="stop_order{{ $stop->id }}" class="form-control" value="{{ $stop->stop_order }}" min="1">
            </div>

            <div class="mb-3">
              <label for="distance_from_origin{{ $stop->id }}" class="form-label">Distance from Origin (km)</label>
              <input type="number" name="distance_from_origin" id="distance_from_origin{{ $stop->id }}" class="form-control" value="{{ $stop->distance_from_origin }}" step="0.1" min="0">
            </div>

            <div class="mb-3">
              <label for="estimated_time_min{{ $stop->id }}" class="form-label">Estimated Time (min)</label>
              <input type="number" name="estimated_time_min" id="estimated_time_min{{ $stop->id }}" class="form-control" value="{{ $stop->estimated_time_min }}" min="0">
            </div>

            <div class="mb-3 form-check">
              <input type="checkbox" name="is_active" id="is_active{{ $stop->id }}" class="form-check-input" {{ $stop->is_active ? 'checked' : '' }}>
              <label for="is_active{{ $stop->id }}" class="form-check-label">Active</label>
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
