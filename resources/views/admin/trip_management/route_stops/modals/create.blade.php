<!-- resources/views/admin/trip_management/route_stops/modals/create.blade.php -->
<div class="modal fade" id="createRouteStopModal" tabindex="-1" aria-labelledby="createRouteStopModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="{{ route('admin.route-stops.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createRouteStopModalLabel">Add Route Stop</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="route_id" class="form-label">Route</label>
            <select name="route_id" id="route_id" class="form-select" required>
              <option value="">Select Route</option>
              @foreach($routes as $route)
                <option value="{{ $route->id }}">{{ $route->originTerminal->name ?? '-' }} → {{ $route->destinationTerminal->name ?? '-' }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="stop_id" class="form-label">Stop</label>
            <select name="stop_id" id="stop_id" class="form-select" required>
              <option value="">Select Stop</option>
              @foreach($stops as $stop)
                <option value="{{ $stop->id }}">{{ $stop->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="stop_order" class="form-label">Order</label>
            <input type="number" name="stop_order" id="stop_order" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="distance_from_origin" class="form-label">Distance from Origin (km)</label>
            <input type="number" step="0.01" name="distance_from_origin" id="distance_from_origin" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="estimated_time_min" class="form-label">Estimated Time (min)</label>
            <input type="number" name="estimated_time_min" id="estimated_time_min" class="form-control" required>
          </div>

          <div class="form-check mb-3">
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
