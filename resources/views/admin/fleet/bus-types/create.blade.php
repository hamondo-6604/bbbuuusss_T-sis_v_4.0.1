@extends('layouts.app')

@section('content')

  <div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
      <h2 class="fw-bold">Add Bus Type</h2>
      <a href="{{ route('admin.bus-types.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Back
      </a>
    </div>

    <div class="card shadow-sm">
      <div class="card-body">
        <form action="{{ route('admin.bus-types.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="type_name" class="form-label">Type Name</label>
            <input type="text" name="type_name" id="type_name" class="form-control @error('type_name') is-invalid @enderror"
                   value="{{ old('type_name') }}" placeholder="Enter bus type" required>
            @error('type_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="deck_type" class="form-label">Deck Type</label>
            <select name="deck_type" id="deck_type" class="form-select @error('deck_type') is-invalid @enderror" required>
              <option value="single" {{ old('deck_type') == 'single' ? 'selected' : '' }}>Single</option>
              <option value="double" {{ old('deck_type') == 'double' ? 'selected' : '' }}>Double</option>
            </select>
            @error('deck_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3"
                      placeholder="Optional">{{ old('description') }}</textarea>
            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">
              <i class="bi bi-plus-circle"></i> Add Bus Type
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
