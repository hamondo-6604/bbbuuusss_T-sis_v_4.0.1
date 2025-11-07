@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Edit Seat Layout — {{ $seatLayout->layout_name }}</h4>
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
                    <label class="form-label">Layout Name</label>
                    <input type="text" name="layout_name" class="form-control" value="{{ old('layout_name', $seatLayout->layout_name) }}" required>
                    @error('layout_name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Rows</label>
                        <input type="number" name="total_rows" class="form-control" value="{{ old('total_rows', $seatLayout->total_rows) }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Columns</label>
                        <input type="number" name="total_columns" class="form-control" value="{{ old('total_columns', $seatLayout->total_columns) }}" required>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Capacity</label>
                        <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $seatLayout->capacity) }}">
                        <small class="text-muted">Optional — will be auto-calculated if left blank.</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $seatLayout->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $seatLayout->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $seatLayout->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
