@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Add Route Stop</h2>
      <a href="{{ route('admin.route-stops.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('admin.route-stops.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="route_id" class="form-label">Route</label>
            <select name="route_id" id="route_id" class="form-select @error('route_id') is-invalid @enderror" required>
              <option value="">Select Route</option>
              @foreach($routes as $route)
                <option value="{{ $route->id }}" {{ old('route_id') == $route->id ? 'selected' : '' }}>
                  {{ $route->originTerminal->name }} → {{ $route->destinationTerminal->name }}
                </option>
              @endforeach
            </select>
            @error('route_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="stop_id" class="form-label">Stop</label>
            <select name="stop_id" id="stop_id" class="form-select @error('stop_id') is-invalid @enderror" required>
              <option value="">Select Stop</option>
              @foreach($stops as $stop)
                <option value="{{ $stop->id }}" {{ old('stop_id') == $stop->id ? 'selected' : '' }}>
                  {{ $stop->name }} ({{ $stop->city->name }})
                </option>
              @endforeach
            </select>
            @error('stop_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="stop_order" class="form-label">Stop Order</label>
            <input type="number" name="stop_order" id="stop_order" class="form-control @error('stop_order') is-invalid @enderror"
                   value="{{ old('stop_order') }}" required>
            @error('stop_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="distance_from_origin" class="form-label">Distance from Origin (km)</label>
            <input type="number" step="0.01" name="distance_from_origin" id="distance_from_origin" class="form-control @error('distance_from_origin') is-invalid @enderror"
                   value="{{ old('distance_from_origin') }}" required>
            @error('distance_from_origin') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="estimated_time_min" class="form-label">Estimated Time (minutes)</label>
            <input type="number" name="estimated_time_min" id="estimated_time_min" class="form-control @error('estimated_time_min') is-invalid @enderror"
                   value="{{ old('estimated_time_min') }}" required>
            @error('estimated_time_min') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-check mb-3">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active', true) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">
              <i class="bi bi-plus-circle"></i> Add Route Stop
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
