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

    <!-- Left Column: Create New Bus Form -->
    <div class="column">
        <div class="login-card">
            <h3 style="margin-bottom:16px;">Create New Bus</h3>
            <form id="createBusForm" action="{{ route('admin.buses.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Bus Number & Bus Name -->
                <div class="form-row">
                    <div class="form-group">
                        <label for="busNumber">Bus Number</label>
                        <input type="text" name="bus_number" id="busNumber" value="{{ old('bus_number') }}" required>
                        @error('bus_number')<div class="error-message">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label for="busName">Bus Name</label>
                        <input type="text" name="bus_name" id="busName" value="{{ old('bus_name') }}" required>
                        @error('bus_name')<div class="error-message">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Bus Type -->
                <div class="form-group">
                    <label for="busType">Bus Type</label>
                    <select name="bus_type_id" id="busType" required>
                        <option value="">-- Select Bus Type --</option>
                        @foreach($busTypes as $type)
                            @if($type->seatLayout)
                                <option 
                                    value="{{ $type->id }}"
                                    data-layout="{{ $type->seatLayout->layout_name }}"
                                    data-layout-id="{{ $type->seatLayout->id }}"
                                    data-total="{{ $type->seatLayout->capacity }}"
                                    {{ old('bus_type_id') == $type->id ? 'selected' : '' }}>
                                    {{ $type->type_name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                    @error('bus_type_id')<div class="error-message">{{ $message }}</div>@enderror
                </div>

                <!-- Seat Layout & Total Seats -->
                <div class="form-row">
                    <div class="form-group">
                        <label>Seat Layout</label>
                        <input type="text" id="seatLayout" value="{{ old('seat_layout_name') }}" disabled>
                        <input type="hidden" name="seat_layout_id" id="seatLayoutId" value="{{ old('seat_layout_id') }}">
                    </div>

                    <div class="form-group">
                        <label>Total Seats</label>
                        <input type="number" id="totalSeats" value="{{ old('total_seats') }}" disabled>
                        <input type="hidden" name="total_seats" id="totalSeatsHidden" value="{{ old('total_seats') }}">
                    </div>
                </div>

                <!-- Bus Image -->
                <div class="form-group">
                    <label for="busImage">Bus Image</label>
                    <input type="file" name="bus_img" id="busImage">
                    @error('bus_img')<div class="error-message">{{ $message }}</div>@enderror
                </div>

                <!-- Status -->
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="status" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                    @error('status')<div class="error-message">{{ $message }}</div>@enderror
                </div>

                <!-- Description -->
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')<div class="error-message">{{ $message }}</div>@enderror
                </div>

                <button type="submit" class="login-btn">Save Bus</button>
            </form>
        </div>
    </div>

    <!-- Right Column: Live Preview -->
    <div class="column">
        <div class="login-card">
            <h3 style="margin-bottom:16px;">Bus Details Preview</h3>
            <p><strong>Bus Number:</strong> <span id="previewBusNumber">—</span></p>
            <p><strong>Bus Name:</strong> <span id="previewBusName">—</span></p>
            <p><strong>Bus Type:</strong> <span id="previewBusType">—</span></p>
            <p><strong>Seat Layout:</strong> <span id="previewSeatLayout">—</span></p>
            <p><strong>Total Seats:</strong> <span id="previewTotalSeats">—</span></p>
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
    // Inputs
    const busNumber = document.getElementById('busNumber');
    const busName = document.getElementById('busName');
    const busType = document.getElementById('busType');
    const seatLayout = document.getElementById('seatLayout');
    const seatLayoutId = document.getElementById('seatLayoutId');
    const totalSeats = document.getElementById('totalSeats');
    const totalSeatsHidden = document.getElementById('totalSeatsHidden');
    const status = document.getElementById('status');
    const description = document.getElementById('description');

    // Preview fields
    const previewBusNumber = document.getElementById('previewBusNumber');
    const previewBusName = document.getElementById('previewBusName');
    const previewBusType = document.getElementById('previewBusType');
    const previewSeatLayout = document.getElementById('previewSeatLayout');
    const previewTotalSeats = document.getElementById('previewTotalSeats');
    const previewStatus = document.getElementById('previewStatus');
    const previewDescription = document.getElementById('previewDescription');

    // Bind real-time mirroring
    const mirror = (input, target) => {
        input.addEventListener('input', () => target.textContent = input.value.trim() || '—');
    };

    mirror(busNumber, previewBusNumber);
    mirror(busName, previewBusName);
    mirror(description, previewDescription);

    // Bus type and seat layout updates
    busType.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const layout = selected.dataset.layout || '';
        const layoutId = selected.dataset.layoutId || '';
        const total = selected.dataset.total || '';

        seatLayout.value = layout;
        seatLayoutId.value = layoutId;
        totalSeats.value = total;
        totalSeatsHidden.value = total;

        previewBusType.textContent = selected.textContent.trim() || '—';
        previewSeatLayout.textContent = layout || '—';
        previewTotalSeats.textContent = total || '—';
    });

    // Status
    status.addEventListener('change', function () {
        previewStatus.textContent = this.options[this.selectedIndex].text;
    });

    // Initial trigger
    if (busType.value) busType.dispatchEvent(new Event('change'));
    if (status.value) status.dispatchEvent(new Event('change'));
});
</script>
@endpush
