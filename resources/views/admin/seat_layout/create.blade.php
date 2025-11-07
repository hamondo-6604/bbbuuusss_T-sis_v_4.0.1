@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">Add New Seat Layout</h4>
        <a href="{{ route('admin.seat-layouts.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.seat-layouts.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Layout Name</label>
                    <input type="text" name="layout_name" class="form-control" value="{{ old('layout_name') }}" required>
                    @error('layout_name') <div class="text-danger small">{{ $message }}</div> @enderror
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Rows</label>
                        <input type="number" name="total_rows" id="total_rows" class="form-control" value="{{ old('total_rows') }}" required>
                        @error('total_rows') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Columns</label>
                        <input type="number" name="total_columns" id="total_columns" class="form-control" value="{{ old('total_columns') }}" required>
                        @error('total_columns') <div class="text-danger small">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Capacity</label>
                        <input type="number" name="capacity" id="capacity" class="form-control bg-light" readonly>
                        <small class="text-muted">Automatically calculated (rows × columns)</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Save
                </button>
            </form>
        </div>
    </div>
</div>

{{-- 🔹 Auto Calculate Capacity --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const rows = document.getElementById('total_rows');
    const cols = document.getElementById('total_columns');
    const capacity = document.getElementById('capacity');

    function updateCapacity() {
        const r = parseInt(rows.value) || 0;
        const c = parseInt(cols.value) || 0;
        capacity.value = r * c;
    }

    rows.addEventListener('input', updateCapacity);
    cols.addEventListener('input', updateCapacity);
});
</script>
@endsection
