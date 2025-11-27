@extends('layouts.app')

@section('title', 'Create Schedule')

@section('content')
  <div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">
      <div class="card-header bg-white">
        <h5 class="mb-0 fw-bold">Add Schedule</h5>
      </div>
      <div class="card-body">

        <form action="{{ route('admin.schedules.store') }}" method="POST">
          @csrf

          {{-- Bus --}}
          <div class="mb-3">
            <label for="bus_id" class="form-label">Bus</label>
            <select name="bus_id" id="bus_id" class="form-select" required>
              <option value="">-- Select Bus --</option>
              @foreach($buses as $bus)
                <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                  {{ $bus->bus_number }} ({{ $bus->busType->type_name ?? '' }})
                </option>
              @endforeach
            </select>
            @error('bus_id') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Route --}}
          <div class="mb-3">
            <label for="route_id" class="form-label">Route</label>
            <select name="route_id" id="route_id" class="form-select" required>
              <option value="">-- Select Route --</option>
              @foreach($routes as $route)
                <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                  {{ $route->originTerminal->name ?? 'N/A' }}
                  @if($route->via) → {{ $route->via }} @endif
                  → {{ $route->destinationTerminal->name ?? 'N/A' }}
                </option>
              @endforeach
            </select>
            @error('route_id') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Departure Terminal --}}
          <div class="mb-3">
            <label for="departure_terminal_id" class="form-label">Departure Terminal</label>
            <select name="departure_terminal_id" id="departure_terminal_id" class="form-select" required>
              <option value="">-- Select Departure Terminal --</option>
              @foreach($terminals as $terminal)
                <option value="{{ $terminal->id }}" {{ old('departure_terminal_id') == $terminal->id ? 'selected' : '' }}>
                  {{ $terminal->name }} ({{ $terminal->city->name ?? '' }})
                </option>
              @endforeach
            </select>
            @error('departure_terminal_id') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Arrival Terminal --}}
          <div class="mb-3">
            <label for="arrival_terminal_id" class="form-label">Arrival Terminal</label>
            <select name="arrival_terminal_id" id="arrival_terminal_id" class="form-select" required>
              <option value="">-- Select Arrival Terminal --</option>
              @foreach($terminals as $terminal)
                <option value="{{ $terminal->id }}" {{ old('arrival_terminal_id') == $terminal->id ? 'selected' : '' }}>
                  {{ $terminal->name }} ({{ $terminal->city->name ?? '' }})
                </option>
              @endforeach
            </select>
            @error('arrival_terminal_id') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Departure & Arrival --}}
          <div class="mb-3">
            <label for="departure_time" class="form-label">Departure Time</label>
            <input type="datetime-local" name="departure_time" id="departure_time"
                   class="form-control" value="{{ old('departure_time') }}" required>
            @error('departure_time') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <div class="mb-3">
            <label for="arrival_time" class="form-label">Arrival Time</label>
            <input type="datetime-local" name="arrival_time" id="arrival_time"
                   class="form-control" value="{{ old('arrival_time') }}" required>
            @error('arrival_time') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          {{-- Status --}}
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
              <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
              <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
              <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            @error('status') <small class="text-danger">{{ $message }}</small> @enderror
          </div>

          <button type="submit" class="btn btn-success">Create Schedule</button>
        </form>

      </div>
    </div>
  </div>
@endsection
