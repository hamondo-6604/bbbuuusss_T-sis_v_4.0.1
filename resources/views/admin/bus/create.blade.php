@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Add New Bus</h4>

    <form action="{{ route('admin.buses.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Bus Number --}}
        <div class="mb-3">
            <label class="form-label">Bus Number</label>
            <input type="text" name="bus_number" class="form-control" value="{{ old('bus_number') }}" required>
            @error('bus_number')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        {{-- Bus Name --}}
        <div class="mb-3">
            <label class="form-label">Bus Name</label>
            <input type="text" name="bus_name" class="form-control" value="{{ old('bus_name') }}" required>
            @error('bus_name')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        {{-- Bus Type --}}
        <div class="mb-3">
            <label class="form-label">Bus Type</label>
            <select name="bus_type_id" id="busType" class="form-select" required>
                <option value="">-- Select Bus Type --</option>
                @foreach($busTypes as $type)
                    @if($type->seatLayout) {{-- Only include if seatLayout exists --}}
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
            @error('bus_type_id')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        {{-- Seat Layout --}}
        <div class="mb-3">
            <label class="form-label">Seat Layout</label>
            <input type="text" id="seatLayout" class="form-control" value="{{ old('seat_layout_name') }}" disabled>
            <input type="hidden" name="seat_layout_id" id="seatLayoutId" value="{{ old('seat_layout_id') }}">
        </div>

        {{-- Total Seats --}}
        <div class="mb-3">
            <label class="form-label">Total Seats</label>
            <input type="number" id="totalSeats" class="form-control" value="{{ old('total_seats') }}" disabled>
            <input type="hidden" name="total_seats" id="totalSeatsHidden" value="{{ old('total_seats') }}">
        </div>

        {{-- Bus Image --}}
        <div class="mb-3">
            <label class="form-label">Bus Image</label>
            <input type="file" name="bus_img" class="form-control">
            @error('bus_img')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
            </select>
            @error('status')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        {{-- Description --}}
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            @error('description')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Bus</button>
    </form>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const busTypeSelect = document.getElementById('busType');
    const seatLayoutInput = document.getElementById('seatLayout');
    const seatLayoutIdHidden = document.getElementById('seatLayoutId');
    const totalSeatsInput = document.getElementById('totalSeats');
    const totalSeatsHidden = document.getElementById('totalSeatsHidden');

    busTypeSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];

        // Use dataset for easier access
        const layout = selected.dataset.layout || '';
        const layoutId = selected.dataset.layoutId || '';
        const totalSeats = selected.dataset.total || '';

        seatLayoutInput.value = layout;
        seatLayoutIdHidden.value = layoutId;
        totalSeatsInput.value = totalSeats;
        totalSeatsHidden.value = totalSeats;
    });

    // Trigger change on page load if a bus type was previously selected (old input)
    if(busTypeSelect.value) {
        busTypeSelect.dispatchEvent(new Event('change'));
    }
});
</script>
@endpush
