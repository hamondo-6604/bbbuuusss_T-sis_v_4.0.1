<!-- resources/views/admin/schedules/modals/create.blade.php -->
<div class="modal fade" id="createScheduleModal" tabindex="-1" aria-labelledby="createScheduleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.schedules.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="createScheduleModalLabel">Create Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="route_id" class="form-label">Route</label>
            <select name="route_id" id="route_id" class="form-select">
              @foreach($routes as $route)
                <option value="{{ $route->id }}">
                  {{ $route->originTerminal->name }} →
                  {{ $route->via ? $route->via . ' → ' : '' }}
                  {{ $route->destinationTerminal->name }}
                </option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="bus_id" class="form-label">Bus</label>
            <select name="bus_id" id="bus_id" class="form-select">
              @foreach($buses as $bus)
                <option value="{{ $bus->id }}">{{ $bus->bus_number }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="departure_time" class="form-label">Departure Time</label>
            <input type="datetime-local" name="departure_time" id="departure_time" class="form-control">
          </div>
          <div class="mb-3">
            <label for="arrival_time" class="form-label">Arrival Time</label>
            <input type="datetime-local" name="arrival_time" id="arrival_time" class="form-control">
          </div>
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
              <option value="active">Active</option>
              <option value="cancelled">Cancelled</option>
              <option value="completed">Completed</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Schedule</button>
        </div>
      </form>
    </div>
  </div>
</div>
