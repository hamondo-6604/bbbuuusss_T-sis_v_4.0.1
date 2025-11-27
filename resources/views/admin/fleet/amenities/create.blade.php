@extends('layouts.app')

@section('content')

  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="fw-bold">Add New Amenity</h2>
      <a href="{{ route('admin.amenities.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
      </a>
    </div>

    <!-- Card -->
    <div class="card shadow-sm">
      <div class="card-body">

        <form action="{{ route('admin.amenities.store') }}" method="POST">
          @csrf

          <!-- Name Field -->
          <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Amenity Name</label>
            <input type="text" name="name" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   placeholder="Enter amenity name" required>

            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Icon Field -->
          <div class="mb-3">
            <label for="icon" class="form-label fw-semibold">Icon (Ionicons name)</label>
            <input type="text" name="icon" id="icon"
                   class="form-control @error('icon') is-invalid @enderror"
                   value="{{ old('icon') }}"
                   placeholder="e.g. wifi-outline, water-outline">

            <small class="text-muted">
              Optional. Find icons at <a href="https://ionic.io/ionicons" target="_blank">Ionicons Library</a>
            </small>

            @error('icon')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <!-- Submit -->
          <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary px-4">
              <i class="bi bi-plus-circle"></i> Add Amenity
            </button>
          </div>
        </form>

      </div>
    </div>
  </div>

@endsection
