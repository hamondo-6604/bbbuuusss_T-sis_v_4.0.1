<!-- resources/views/admin/schedules/modals/edit.blade.php -->
@foreach($schedules as $schedule)
  <div class="modal fade" id="editScheduleModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="editScheduleModalLabel{{ $schedule->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-header">
            <h5 class="modal-title" id="editScheduleModalLabel{{ $schedule->id }}">Edit Schedule</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="route_id{{ $schedule->id }}" class="form-label">Route</label>
              <select name="route_id" id="route_id{{ $schedule->id }}" class="form-select">
                @foreach($routes as $route)
                  <option value="{{ $route->id }}" {{ $schedule->route_id == $route->id ? 'selected' : '' }}>
                    {{ $route->originTerminal->name }} →
                    {{ $route->via ? $route->via . ' → ' : '' }}
                    {{ $route->destinationTerminal->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="bus_id{{ $schedule->id }}" class="form-label">Bus</label>
              <select name="bus_id" id="bus_id{{ $schedule->id }}" class="form-select">
                @foreach($buses as $bus)
                  <option value="{{ $bus->id }}" {{ $schedule->bus_id == $bus->id ? 'selected' : '' }}>
                    {{ $bus->bus_number }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="departure_time{{ $schedule->id }}" class="form-label">Departure Time</label>
              <input type="datetime-local" name="departure_time" id="departure_time{{ $schedule->id }}" class="form-control" value="{{ \Carbon\Carbon::parse($schedule->departure_time)->format('Y-m-d\TH:i') }}">
            </div>
            <div class="mb-3">
              <label for="arrival_time{{ $schedule->id }}" class="form-label">Arrival Time</label>
              <input type="datetime-local" name="arrival_time" id="arrival_time{{ $schedule->id }}" class="form-control" value="{{ \Carbon\Carbon::parse($schedule->arrival_time)->format('Y-m-d\TH:i') }}">
            </div>
            <div class="mb-3">
              <label for="status{{ $schedule->id }}" class="form-label">Status</label>
              <select name="status" id="status{{ $schedule->id }}" class="form-select">
                <option value="active" {{ $schedule->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="cancelled" {{ $schedule->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="completed" {{ $schedule->status == 'completed' ? 'selected' : '' }}>Completed</option>
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
