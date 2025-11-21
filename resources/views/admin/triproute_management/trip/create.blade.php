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

    .card-box {
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
    .form-group select {
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
    .form-group select:focus {
      border-color: #6366F1;
      box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
    }

    .error-message {
      color: #dc2626;
      font-size: 12px;
      margin-top: 2px;
    }

    .save-btn {
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

    .save-btn:hover {
      background: #4f46e5;
    }

    @media (max-width: 900px) {
      .container-flex {
        flex-direction: column;
      }
    }
  </style>

  <div class="container-flex">

    <!-- Left Column: Trip Form -->
    <div class="column">
      <div class="card-box">
        <h3 style="margin-bottom:16px;">
          {{ isset($trip) ? 'Edit Trip' : 'Create Trip' }}
        </h3>

        <form action="{{ isset($trip) ? route('admin.trips.update', $trip->id) : route('admin.trips.store') }}" method="POST">
          @csrf
          @if(isset($trip))
            @method('PUT')
          @endif

          <!-- Trip Code -->
          <div class="form-group">
            <label>Trip Code</label>
            <input type="text" name="trip_code" value="{{ old('trip_code', $trip->trip_code ?? '') }}" required>
            @error('trip_code') <div class="error-message">{{ $message }}</div> @enderror
          </div>

          <!-- Route -->
          <div class="form-group">
            <label>Route</label>
            <select name="route_id" required>
              <option value="" disabled selected hidden>Select Route</option>
              @foreach($routes as $route)
                <option value="{{ $route->id }}"
                  {{ old('route_id', $trip->route_id ?? '') == $route->id ? 'selected' : '' }}>
                  {{ $route->route_name }}
                </option>
              @endforeach
            </select>
            @error('route_id')
            <div class="error-message">{{ $message }}</div>
            @enderror
          </div>


          <!-- Bus -->
          <div class="form-group">
            <label>Bus</label>
            <select name="bus_id" required>
              <option value="" disabled selected hidden>Select Bus</option>
              @foreach($buses as $bus)
                <option value="{{ $bus->id }}"
                  {{ old('bus_id', $trip->bus_id ?? '') == $bus->id ? 'selected' : '' }}>
                  {{ $bus->bus_name ?? $bus->name }}
                </option>
              @endforeach
            </select>
            @error('bus_id') <div class="error-message">{{ $message }}</div> @enderror
          </div>

          <!-- Date -->
          <div class="form-group">
            <label>Trip Date</label>
            <input type="date" name="trip_date" value="{{ old('trip_date', $trip->trip_date ?? '') }}" required>
            @error('trip_date') <div class="error-message">{{ $message }}</div> @enderror
          </div>

          <!-- Time Fields -->
          <div class="form-row">
            <div class="form-group">
              <label>Departure Time</label>
              <input type="time" name="departure_time" value="{{ old('departure_time', $trip->departure_time ?? '') }}" required>
              @error('departure_time') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
              <label>Arrival Time</label>
              <input type="time" name="arrival_time" value="{{ old('arrival_time', $trip->arrival_time ?? '') }}">
              @error('arrival_time') <div class="error-message">{{ $message }}</div> @enderror
            </div>
          </div>

          <!-- Seats & Fare -->
          <div class="form-row">
            <div class="form-group">
              <label>Available Seats</label>
              <input type="number" name="available_seats" value="{{ old('available_seats', $trip->available_seats ?? 0) }}" required>
              @error('available_seats') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
              <label>Fare</label>
              <input type="number" step="0.01" name="fare" value="{{ old('fare', $trip->fare ?? '') }}">
              @error('fare') <div class="error-message">{{ $message }}</div> @enderror
            </div>
          </div>

          <button class="save-btn">{{ isset($trip) ? 'Update Trip' : 'Save Trip' }}</button>
        </form>
      </div>
    </div>

  </div>
@endsection
