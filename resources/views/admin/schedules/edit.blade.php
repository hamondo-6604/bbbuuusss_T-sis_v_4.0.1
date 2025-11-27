@extends('layouts.app')

@section('title', 'Edit Schedule')

@section('content')
  @include('message')
  <div class="container-fluid mt-4">

    <div class="card shadow-sm border-0">
      <div class="card-header bg-white">
        <h5 class="fw-bold mb-0">Edit Schedule</h5>
      </div>

      <div class="card-body">

        <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="row">

            <div class="col-md-6 mb-3">
              <label class="form-label">Trip Route <span class="text-danger">*</span></label>
              <select name="trip_id" class="form-select @error('trip_id') is-invalid @enderror">
                <option value="">-- Select Route --</option>
                @foreach ($trips as $trip)
                  <option value="{{ $trip->id }}" {{ $schedule->trip_id == $trip->id ? 'selected' : '' }}>
                    {{ $trip->route->name ?? '' }}
                  </option>
                @endforeach
              </select>
              @error('trip_id')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Bus <span class="text-danger">*</span></label>
              <select name="bus_id" class="form-select @error('bus_id') is-invalid @enderror">
                <option value="">-- Select Bus --</option>
                @foreach ($buses as $bus)
                  <option value="{{ $bus->id }}" {{ $schedule->bus_id == $bus->id ? 'selected' : '' }}>
                    {{ $bus->bus_number }}
                  </option>
                @endforeach
              </select>
              @error('bus_id')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Departure Time <span class="text-danger">*</span></label>
              <input type="datetime-local" name="departure_time"
                     class="form-control @error('departure_time') is-invalid @enderror"
                     value="{{ old('departure_time', \Carbon\Carbon::parse($schedule->departure_time)->format('Y-m-d\TH:i')) }}">
              @error('departure_time')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Arrival Time <span class="text-danger">*</span></label>
              <input type="datetime-local" name="arrival_time"
                     class="form-control @error('arrival_time') is-invalid @enderror"
                     value="{{ old('arrival_time', \Carbon\Carbon::parse($schedule->arrival_time)->format('Y-m-d\TH:i')) }}">
              @error('arrival_time')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label">Status</label>
              <select name="status" class="form-select @error('status') is-invalid @enderror">
                <option value="1" {{ $schedule->status == 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $schedule->status == 0 ? 'selected' : '' }}>Inactive</option>
              </select>
              @error('status')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

          </div>

          <div class="d-flex justify-content-end mt-4">
            <a href="{{ route('admin.schedules.index') }}" class="btn btn-secondary me-2">
              Cancel
            </a>
            <button type="submit" class="btn btn-primary">
              Update Schedule
            </button>
          </div>

        </form>

      </div>
    </div>
  </div>
@endsection
