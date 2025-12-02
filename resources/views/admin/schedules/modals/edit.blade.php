@foreach($schedules as $schedule)
  <!-- Edit Schedule Modal -->
  <div class="modal fade" id="editScheduleModal{{ $schedule->id }}" tabindex="-1" aria-labelledby="editScheduleLabel{{ $schedule->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title" id="editScheduleLabel{{ $schedule->id }}">Edit Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="modal-body">

            {{-- Validation Errors --}}
            @if($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            {{-- Route --}}
            <div class="mb-3">
              <label for="route_id{{ $schedule->id }}" class="form-label">Route</label>
              <select name="route_id" id="route_id{{ $schedule->id }}" class="form-select" required>
                <option value="" disabled>Select Route</option>
                @foreach($routes as $route)
                  <option value="{{ $route->id }}" {{ $schedule->route_id == $route->id ? 'selected' : '' }}>
                    {{ $route->originTerminal->name ?? 'N/A' }} 
                    @if($route->via) → {{ $route->via }} @endif
                    → {{ $route->destinationTerminal->name ?? 'N/A' }}
                  </option>
                @endforeach
              </select>
            </div>

            {{-- Bus --}}
            <div class="mb-3">
              <label for="bus_id{{ $schedule->id }}" class="form-label">Bus</label>
              <select name="bus_id" id="bus_id{{ $schedule->id }}" class="form-select" required>
                <option value="" disabled>Select Bus</option>
                @foreach($buses as $bus)
                  <option value="{{ $bus->id }}" {{ $schedule->bus_id == $bus->id ? 'selected' : '' }}>
                    {{ $bus->bus_number }}
                  </option>
                @endforeach
              </select>
            </div>

            {{-- Departure Time --}}
            <div class="mb-3">
              <label for="departure_time{{ $schedule->id }}" class="form-label">Departure Time</label>
              <input type="datetime-local" name="departure_time" id="departure_time{{ $schedule->id }}" class="form-control" 
                     value="{{ old('departure_time', \Carbon\Carbon::parse($schedule->departure_time)->format('Y-m-d\TH:i')) }}" required>
            </div>

            {{-- Arrival Time --}}
            <div class="mb-3">
              <label for="arrival_time{{ $schedule->id }}" class="form-label">Arrival Time</label>
              <input type="datetime-local" name="arrival_time" id="arrival_time{{ $schedule->id }}" class="form-control" 
                     value="{{ old('arrival_time', \Carbon\Carbon::parse($schedule->arrival_time)->format('Y-m-d\TH:i')) }}" required>
            </div>

            {{-- Status --}}
            <div class="mb-3">
              <label for="status{{ $schedule->id }}" class="form-label">Status</label>
              <select name="status" id="status{{ $schedule->id }}" class="form-select" required>
                <option value="active" {{ $schedule->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="cancelled" {{ $schedule->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="completed" {{ $schedule->status == 'completed' ? 'selected' : '' }}>Completed</option>
              </select>
            </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-warning">Update Schedule</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach
