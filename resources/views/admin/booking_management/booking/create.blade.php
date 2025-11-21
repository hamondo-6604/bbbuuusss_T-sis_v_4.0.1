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

    <div class="column">
      <div class="card-box">
        <h3 style="margin-bottom:16px;">Create Booking</h3>

        @if($errors->any())
          <div class="error-message" style="margin-bottom: 10px;">
            @foreach($errors->all() as $error)
              • {{ $error }} <br>
            @endforeach
          </div>
        @endif

        <form action="{{ route('admin.bookings.store') }}" method="POST">
          @csrf

          <!-- User -->
          <div class="form-group">
            <label>User</label>
            <select name="user_id" required>
              <option value="" disabled selected hidden>Select User</option>
              @foreach(\App\Models\User::all() as $user)
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                  {{ $user->name }}
                </option>
              @endforeach
            </select>
            @error('user_id') <div class="error-message">{{ $message }}</div> @enderror
          </div>

          <!-- Bus -->
          <div class="form-group">
            <label>Bus</label>
            <select name="bus_id" required>
              <option value="" disabled selected hidden>Select Bus</option>
              @foreach(\App\Models\Bus::all() as $bus)
                <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                  {{ $bus->bus_name }}
                </option>
              @endforeach
            </select>
            @error('bus_id') <div class="error-message">{{ $message }}</div> @enderror
          </div>

          <!-- Seat Number / Type -->
          <div class="form-row">
            <div class="form-group">
              <label>Seat Number</label>
              <input type="text" name="seat_number" value="{{ old('seat_number') }}">
              @error('seat_number') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
              <label>Seat Type</label>
              <select name="seat_type">
                <option value="economy" {{ old('seat_type') == 'economy' ? 'selected' : '' }}>Economy</option>
                <option value="business" {{ old('seat_type') == 'business' ? 'selected' : '' }}>Business</option>
              </select>
              @error('seat_type') <div class="error-message">{{ $message }}</div> @enderror
            </div>
          </div>

          <!-- Status -->
          <div class="form-group">
            <label>Status</label>
            <select name="status">
              @foreach(['pending','confirmed','cancelled','completed'] as $status)
                <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                  {{ ucfirst($status) }}
                </option>
              @endforeach
            </select>
            @error('status') <div class="error-message">{{ $message }}</div> @enderror
          </div>

          <!-- Times -->
          <div class="form-row">
            <div class="form-group">
              <label>Departure Time</label>
              <input type="datetime-local" name="departure_time" value="{{ old('departure_time') }}">
              @error('departure_time') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
              <label>Arrival Time</label>
              <input type="datetime-local" name="arrival_time" value="{{ old('arrival_time') }}">
              @error('arrival_time') <div class="error-message">{{ $message }}</div> @enderror
            </div>
          </div>

          <!-- Payment -->
          <div class="form-row">
            <div class="form-group">
              <label>Amount Paid</label>
              <input type="number" step="0.01" name="amount_paid" value="{{ old('amount_paid') }}">
              @error('amount_paid') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
              <label>Payment Status</label>
              <select name="payment_status">
                <option value="unpaid" {{ old('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
              </select>
              @error('payment_status') <div class="error-message">{{ $message }}</div> @enderror
            </div>
          </div>

          <button class="save-btn">Create Booking</button>
        </form>
      </div>
    </div>

  </div>
@endsection
