<!-- Create Schedule Modal -->
<div class="modal fade" id="createScheduleModal" tabindex="-1" aria-labelledby="createScheduleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.schedules.store') }}" method="POST">
        @csrf

        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="createScheduleModalLabel">Add New Schedule</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row g-3">

            <!-- Bus -->
            <div class="col-md-6">
              <label for="bus_id" class="form-label">Bus <span class="text-danger">*</span></label>
              <select name="bus_id" id="bus_id" class="form-select @error('bus_id') is-invalid @enderror" required>
                <option value="">Select Bus</option>
                @foreach($buses as $bus)
                  <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                    {{ $bus->bus_number }}
                  </option>
                @endforeach
              </select>
              @error('bus_id')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Route -->
            <div class="col-md-6">
              <label for="route_id" class="form-label">Route <span class="text-danger">*</span></label>
              <select name="route_id" id="route_id" class="form-select @error('route_id') is-invalid @enderror" required>
                <option value="">Select Route</option>
                @foreach($routes as $route)
                  <option value="{{ $route->id }}"
                    data-origin="{{ $route->originTerminal->id }}"
                    data-destination="{{ $route->destinationTerminal->id }}">
                    {{ $route->originTerminal->name }}
                    @if($route->via)
                      → {{ $route->via }}
                    @endif
                    → {{ $route->destinationTerminal->name }}
                  </option>
                @endforeach
              </select>
              @error('route_id')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Departure Terminal (readonly) -->
            <div class="col-md-6">
              <label for="departure_terminal_name" class="form-label">Departure Terminal</label>
              <input type="text" id="departure_terminal_name" class="form-control" readonly>
              <input type="hidden" name="departure_terminal_id" id="departure_terminal_id">
            </div>

            <!-- Arrival Terminal (readonly) -->
            <div class="col-md-6">
              <label for="arrival_terminal_name" class="form-label">Arrival Terminal</label>
              <input type="text" id="arrival_terminal_name" class="form-control" readonly>
              <input type="hidden" name="arrival_terminal_id" id="arrival_terminal_id">
            </div>

            <!-- Departure Time -->
            <div class="col-md-6">
              <label for="departure_time" class="form-label">Departure Time <span class="text-danger">*</span></label>
              <input type="datetime-local" name="departure_time" id="departure_time" class="form-control @error('departure_time') is-invalid @enderror" value="{{ old('departure_time') }}" required>
              @error('departure_time')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Arrival Time -->
            <div class="col-md-6">
              <label for="arrival_time" class="form-label">Arrival Time <span class="text-danger">*</span></label>
              <input type="datetime-local" name="arrival_time" id="arrival_time" class="form-control @error('arrival_time') is-invalid @enderror" value="{{ old('arrival_time') }}" required>
              @error('arrival_time')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <!-- Status -->
            <div class="col-12">
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="status" name="status" value="active" {{ old('status', 'active') == 'active' ? 'checked' : '' }}>
                <label class="form-check-label" for="status">Active</label>
              </div>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save Schedule</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- JS to auto-fill terminals -->
<script>
  const routeSelect = document.getElementById('route_id');
  routeSelect.addEventListener('change', function() {
    const selected = routeSelect.options[routeSelect.selectedIndex];
    if (!selected.value) return;

    const originId = selected.dataset.origin;
    const destinationId = selected.dataset.destination;
    const originName = selected.text.split('→')[0].trim();
    const destName = selected.text.split('→').slice(-1)[0].trim();

    document.getElementById('departure_terminal_id').value = originId;
    document.getElementById('departure_terminal_name').value = originName;
    document.getElementById('arrival_terminal_id').value = destinationId;
    document.getElementById('arrival_terminal_name').value = destName;
  });
</script>
