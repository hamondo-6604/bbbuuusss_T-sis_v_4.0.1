@extends('layouts.app')

@section('content')

  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Edit Seat Layout</h2>
      <a href="{{ route('admin.seat-layouts.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('admin.seat-layouts.update', $seatLayout->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-3">
            <label for="layout_name" class="form-label">Layout Name</label>
            <input type="text" name="layout_name" id="layout_name"
                   class="form-control @error('layout_name') is-invalid @enderror"
                   value="{{ old('layout_name', $seatLayout->layout_name) }}" required>
            @error('layout_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="total_seats" class="form-label">Total Seats</label>
            <input type="number" name="total_seats" id="total_seats"
                   class="form-control @error('total_seats') is-invalid @enderror"
                   value="{{ old('total_seats', $seatLayout->total_seats) }}" min="1" required>
            @error('total_seats') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="deck_type" class="form-label">Deck Type</label>
            <select name="deck_type" id="deck_type" class="form-select @error('deck_type') is-invalid @enderror" required>
              <option value="single" {{ old('deck_type', $seatLayout->deck_type) == 'single' ? 'selected' : '' }}>Single</option>
              <option value="double" {{ old('deck_type', $seatLayout->deck_type) == 'double' ? 'selected' : '' }}>Double</option>
            </select>
            @error('deck_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                      rows="3">{{ old('description', $seatLayout->description) }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">
              <i class="bi bi-save"></i> Save Changes
            </button>
          </div>

        </form>
      </div>
    </div>
  </div>

@endsection
