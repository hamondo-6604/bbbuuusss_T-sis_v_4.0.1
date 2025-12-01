<!-- Create Route Stop Modal -->
<div class="modal fade" id="createRouteStopModal" tabindex="-1" aria-labelledby="createRouteStopModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.route-stops.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createRouteStopModalLabel">Create Route Stop</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="route_id" class="form-label">Route</label>
            <select name="route_id" id="route_id" class="form-select">
              @foreach($routes as $route)
                <option value="{{ $route->id }}">
                  {{ $route->originTerminal->name }} → {{ $route->destinationTerminal->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="stop_id" class="form-label">Stop</label>
            <select name="stop_id" id="stop_id" class="form-select">
              @foreach($stops as $stop)
                <option value="{{ $stop->id }}">{{ $stop->name }} ({{ $stop->city->name ?? '-' }})</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="stop_order" class="form-label">Stop Order</label>
            <input type="number" name="stop_order" id="stop_order" class="form-control" min="1">
          </div>

          <div class="mb-3">
            <label for="distance_from_origin" class="form-label">Distance from Origin (km)</label>
            <input type="number" name="distance_from_origin" id="distance_from_origin" class="form-control" step="0.1" min="0">
          </div>

          <div class="mb-3">
            <label for="estimated_time_min" class="form-label">Estimated Time (min)</label>
            <input type="number" name="estimated_time_min" id="estimated_time_min" class="form-control" min="0">
          </div>

          <div class="mb-3 form-check">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" checked>
            <label for="is_active" class="form-check-label">Active</label>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Route Stop</button>
        </div>
      </form>
    </div>
  </div>
</div>
