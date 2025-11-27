@extends('layouts.app')

@section('content')
  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Add New Bus</h2>
      <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('admin.buses.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="bus_number" class="form-label">Bus Number</label>
            <input type="text" name="bus_number" id="bus_number" class="form-control @error('bus_number') is-invalid @enderror"
                   value="{{ old('bus_number') }}" placeholder="Enter bus number" required>
            @error('bus_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="bus_type_id" class="form-label">Bus Type</label>
            <select name="bus_type_id" id="bus_type_id" class="form-select @error('bus_type_id') is-invalid @enderror" required>
              <option value="">Select Bus Type</option>
              @foreach($busTypes as $type)
                <option value="{{ $type->id }}" {{ old('bus_type_id') == $type->id ? 'selected' : '' }}>
                  {{ $type->type_name }}
                </option>
              @endforeach
            </select>
            @error('bus_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="layout_id" class="form-label">Seat Layout</label>
            <select name="seat_layout_id" id="layout_id" class="form-select @error('layout_id') is-invalid @enderror" required>
              <option value="">Select Seat Layout</option>
              @foreach($seatLayouts as $layout)
                <option value="{{ $layout->id }}" {{ old('layout_id') == $layout->id ? 'selected' : '' }}>
                  {{ $layout->layout_name }}
                </option>
              @endforeach
            </select>
            @error('layout_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="capacity" class="form-label">Capacity</label>
            <input type="number" name="capacity" id="capacity" class="form-control @error('capacity') is-invalid @enderror"
                   value="{{ old('capacity') }}" min="1" required>
            @error('capacity') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror" required>
              <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
              <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
              <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
            @error('status') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Amenities</label>
            <div class="d-flex flex-wrap gap-2">
              @foreach($amenities as $amenity)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                         id="amenity_{{ $amenity->id }}" {{ (is_array(old('amenities')) && in_array($amenity->id, old('amenities'))) ? 'checked' : '' }}>
                  <label class="form-check-label" for="amenity_{{ $amenity->id }}">
                    {{ $amenity->name }}
                  </label>
                </div>
              @endforeach
            </div>
            @error('amenities') <div class="text-danger">{{ $message }}</div> @enderror
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">
              <i class="bi bi-plus-circle"></i> Add Bus
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>
@endsection
