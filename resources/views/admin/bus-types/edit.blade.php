@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Edit Bus Type — {{ $busType->type_name }}</h4>
        <a href="{{ route('admin.bus-types.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.bus-types.update', $busType->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Type Name</label>
                    <input type="text" name="type_name" class="form-control" value="{{ old('type_name', $busType->type_name) }}" required>
                    @error('type_name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Seat Layout</label>
                    <select name="seat_layout_id" class="form-select">
                        <option value="">-- Select Layout --</option>
                        @foreach($seatLayouts as $layout)
                            <option value="{{ $layout->id }}" {{ old('seat_layout_id', $busType->seat_layout_id) == $layout->id ? 'selected' : '' }}>
                                {{ $layout->layout_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status', $busType->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $busType->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $busType->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Update
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
