@extends('layouts.app')

@section('content')

<style>
.container-flex {
    display: flex;
    width: 100%;
    gap: 30%;
    margin: 40px auto;
    flex-wrap: wrap;
    padding: 20px;
}

.column {
    flex: 1;
    min-width: 400px;
}

.login-card {
    background: #fff;
    border-radius: 16px;
    padding: 32px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    border: 1px solid #f1f5f9;
}

.form-group {
    margin-bottom: 16px;
}

.form-row {
    display: flex;
    gap: 16px;
}

.form-row .form-group {
    flex: 1;
}

.form-group label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 4px;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    font-size: 14px;
    color: #1e293b;
    font-family: inherit;
    outline: none;
    transition: all 0.2s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #6366F1;
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}

.error-message {
    color: #dc2626;
    font-size: 12px;
    margin-top: 2px;
}

.login-btn {
    width: 100%;
    background: #6366F1;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
}

.login-btn:hover {
    background: #4f46e5;
}

/* Responsive */
@media (max-width: 900px) {
    .container-flex {
        flex-direction: column;
    }
}
</style>

<div class="container-flex">

    <!-- Left Column: Seat Layout Form -->
    <div class="column">
        <div class="login-card">
            <h3 style="margin-bottom:16px;">Add New Seat Layout</h3>

            @if ($errors->any())
                <div class="error-message">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>- {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="seatLayoutForm" action="{{ route('admin.seat-layouts.store') }}" method="POST">
                @csrf

                <!-- Layout Name -->
                <div class="form-group">
                    <label for="layoutName">Layout Name</label>
                    <input type="text" name="layout_name" id="layoutName" value="{{ old('layout_name') }}" required>
                    @error('layout_name')<div class="error-message">{{ $message }}</div>@enderror
                </div>

                <!-- Rows, Columns, Capacity -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="totalRows">Rows</label>
                        <input type="number" name="total_rows" id="totalRows" value="{{ old('total_rows') }}" required>
                        @error('total_rows')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="totalColumns">Columns</label>
                        <input type="number" name="total_columns" id="totalColumns" value="{{ old('total_columns') }}" required>
                        @error('total_columns')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="capacity">Capacity</label>
                        <input type="number" name="capacity" id="capacity" value="{{ old('capacity') }}" readonly style="cursor: default;">
                    </div>
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')<div class="error-message">{{ $message }}</div>@enderror
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" rows="4">{{ old('description') }}</textarea>
                    @error('description')<div class="error-message">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="login-btn">Save Seat Layout</button>
            </form>
        </div>
    </div>

    <!-- Right Column: Live Preview -->
    <div class="column">
        <div class="login-card">
            <h3 style="margin-bottom:16px;">Seat Layout Preview</h3>
            <p><strong>Layout Name:</strong> <span id="previewLayoutName">—</span></p>
            <p><strong>Rows:</strong> <span id="previewRows">—</span></p>
            <p><strong>Columns:</strong> <span id="previewColumns">—</span></p>
            <p><strong>Capacity:</strong> <span id="previewCapacity">—</span></p>
            <p><strong>Status:</strong> <span id="previewStatus">—</span></p>
            <p><strong>Description:</strong></p>
            <p id="previewDescription" style="white-space: pre-line; color:#334155;">—</p>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const layoutName = document.getElementById('layoutName');
    const totalRows = document.getElementById('totalRows');
    const totalColumns = document.getElementById('totalColumns');
    const capacity = document.getElementById('capacity');
    const status = document.getElementById('status');
    const description = document.getElementById('description');

    const previewLayoutName = document.getElementById('previewLayoutName');
    const previewRows = document.getElementById('previewRows');
    const previewColumns = document.getElementById('previewColumns');
    const previewCapacity = document.getElementById('previewCapacity');
    const previewStatus = document.getElementById('previewStatus');
    const previewDescription = document.getElementById('previewDescription');

    // Live preview for text fields
    const mirror = (input, target) => {
        input.addEventListener('input', () => target.textContent = input.value.trim() || '—');
    };

    mirror(layoutName, previewLayoutName);
    mirror(description, previewDescription);

    // Live preview and auto capacity calculation
    const updateCapacity = () => {
        const r = parseInt(totalRows.value) || 0;
        const c = parseInt(totalColumns.value) || 0;
        const total = r * c;
        capacity.value = total;
        previewCapacity.textContent = total || '—';
        previewRows.textContent = r || '—';
        previewColumns.textContent = c || '—';
    };

    totalRows.addEventListener('input', updateCapacity);
    totalColumns.addEventListener('input', updateCapacity);

    // Status preview
    status.addEventListener('change', function () {
        previewStatus.textContent = this.options[this.selectedIndex].text;
    });

    // Initial triggers
    updateCapacity();
    if (status.value) status.dispatchEvent(new Event('change'));
});
</script>
@endpush
