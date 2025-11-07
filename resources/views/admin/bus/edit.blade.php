@extends('layouts.app')

@section('content')
<div class="container">
    <h4 class="mb-4">Edit Bus: {{ $bus->bus_name }}</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.buses.update', $bus->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card p-4 shadow-sm">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Bus Number</label>
                    <input type="text" name="bus_number" class="form-control" value="{{ $bus->bus_number }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bus Name</label>
                    <input type="text" name="bus_name" class="form-control" value="{{ $bus->bus_name }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Bus Type</label>
                    <select name="bus_type_id" class="form-select" required>
                        @foreach($busTypes as $type)
                            <option value="{{ $type->id }}" {{ $bus->bus_type_id == $type->id ? 'selected' : '' }}>
                                {{ $type->type_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Seat Layout</label>
                    <select name="seat_layout_id" class="form-select" required>
                        @foreach($seatLayouts as $layout)
                            <option value="{{ $layout->id }}" {{ $bus->seat_layout_id == $layout->id ? 'selected' : '' }}>
                                {{ $layout->layout_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Total Seats</label>
                    <input type="number" name="total_seats" class="form-control" value="{{ $bus->total_seats }}" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ $bus->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $bus->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="maintenance" {{ $bus->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Bus Image</label>
                    @if($bus->bus_img)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $bus->bus_img) }}" width="80" class="rounded">
                        </div>
                    @endif
                    <input type="file" name="bus_img" class="form-control">
                </div>

                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ $bus->description }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">Update Bus</button>
                <a href="{{ route('admin.buses.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
