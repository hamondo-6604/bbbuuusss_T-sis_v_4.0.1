@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Edit Route</h2>
      <a href="{{ route('admin.routes.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('admin.routes.update', $route->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="origin_terminal_id" class="form-label">Origin Terminal</label>
            <select name="origin_terminal_id" id="origin_terminal_id" class="form-select @error('origin_terminal_id') is-invalid @enderror" required>
              <option value="">Select Origin Terminal</option>
              @foreach($terminals as $terminal)
                <option value="{{ $terminal->id }}" {{ old('origin_terminal_id', $route->origin_terminal_id) == $terminal->id ? 'selected' : '' }}>
                  {{ $terminal->name }} ({{ $terminal->city->name }})
                </option>
              @endforeach
            </select>
            @error('origin_terminal_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="destination_terminal_id" class="form-label">Destination Terminal</label>
            <select name="destination_terminal_id" id="destination_terminal_id" class="form-select @error('destination_terminal_id') is-invalid @enderror" required>
              <option value="">Select Destination Terminal</option>
              @foreach($terminals as $terminal)
                <option value="{{ $terminal->id }}" {{ old('destination_terminal_id', $route->destination_terminal_id) == $terminal->id ? 'selected' : '' }}>
                  {{ $terminal->name }} ({{ $terminal->city->name }})
                </option>
              @endforeach
            </select>
            @error('destination_terminal_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="via" class="form-label">Via (optional)</label>
            <input type="text" name="via" id="via" class="form-control @error('via') is-invalid @enderror" value="{{ old('via', $route->via) }}">
            @error('via') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="distance_km" class="form-label">Distance (km)</label>
            <input type="number" step="0.01" name="distance_km" id="distance_km" class="form-control @error('distance_km') is-invalid @enderror" value="{{ old('distance_km', $route->distance_km) }}" required>
            @error('distance_km') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="duration_min" class="form-label">Duration (minutes)</label>
            <input type="number" name="duration_min" id="duration_min" class="form-control @error('duration_min') is-invalid @enderror" value="{{ old('duration_min', $route->duration_min) }}" required>
            @error('duration_min') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-check mb-3">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active', $route->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
          </div>
