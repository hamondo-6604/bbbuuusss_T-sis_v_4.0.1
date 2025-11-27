@extends('layouts.admin')

@section('content')
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Edit Terminal</h2>
      <a href="{{ route('admin.terminals.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('admin.terminals.update', $terminal->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="city_id" class="form-label">City</label>
            <select name="city_id" id="city_id" class="form-select @error('city_id') is-invalid @enderror" required>
              <option value="">Select City</option>
              @foreach($cities as $city)
                <option value="{{ $city->id }}" {{ old('city_id', $terminal->city_id) == $city->id ? 'selected' : '' }}>
                  {{ $city->name }}
                </option>
              @endforeach
            </select>
            @error('city_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="name" class="form-label">Terminal Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $terminal->name) }}" required>
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="code" class="form-label">Terminal Code (optional)</label>
            <input type="text" name="code" id="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code', $terminal->code) }}">
            @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Address (optional)</label>
            <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address', $terminal->address) }}">
            @error('address') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="latitude" class="form-label">Latitude (optional)</label>
            <input type="number" step="0.000001" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude', $terminal->latitude) }}">
            @error('latitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="longitude" class="form-label">Longitude (optional)</label>
            <input type="number" step="0.000001" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude', $terminal->longitude) }}">
            @error('longitude') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="contact_phone" class="form-label">Contact Phone (optional)</label>
            <input type="text" name="contact_phone" id="contact_phone" class="form-control @error('contact_phone') is-invalid @enderror" value="{{ old('contact_phone', $terminal->contact_phone) }}">
            @error('contact_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-check mb-3">
            <input type="checkbox" name="is_active" id="is_active" class="form-check-input" {{ old('is_active', $terminal->is_active) ? 'checked' : '' }}>
            <label for="is_active" class="form-check-label">Active</label>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">
              <i class="bi bi-save"></i> Update Terminal
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
