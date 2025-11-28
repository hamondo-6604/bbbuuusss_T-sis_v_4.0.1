@extends('layouts.app')

@section('content')

  <div class="max-w-3xl mx-auto py-10">

    <h2 class="text-xl font-bold mb-4">Select Your Seat for {{ $trip->bus->bus_name }}</h2>

    <p class="mb-2">Route: {{ $trip->route->origin }} → {{ $trip->route->destination }}</p>
    <p class="mb-6">Departure: {{ \Carbon\Carbon::parse($trip->departure_time)->format('F j, Y h:i A') }}</p>

    <form id="seatForm" method="POST" action="{{ route('user.bookings.confirm', $trip->id) }}">
      @csrf

      <div class="grid grid-cols-{{ $trip->bus->seatLayout->layout_map['columns'] ?? 4 }} gap-4 mb-6">
        @foreach($seats as $seat)
          <label class="cursor-pointer" title="Class: {{ $seat['type'] }} | {{ $seat['available'] ? 'Available' : 'Booked' }}">
            <input type="radio" name="seat_number" value="{{ $seat['seat_number'] }}" class="hidden seat-radio" {{ $seat['available'] ? '' : 'disabled' }}>
            <div class="
              p-3 text-center rounded-lg border
              {{ $seat['available'] ? 'bg-green-100 hover:bg-green-200' : 'bg-red-300 border-red-500 text-white cursor-not-allowed' }}
            ">
              {{ $seat['seat_number'] }}
            </div>
          </label>
        @endforeach
      </div>

      <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-lg font-bold" disabled id="confirmSeatBtn">
        Continue
      </button>
    </form>

  </div>

  <script>
    const seatRadios = document.querySelectorAll('.seat-radio');
    const confirmBtn = document.getElementById('confirmSeatBtn');

    seatRadios.forEach(seat => {
      seat.addEventListener('change', () => {
        confirmBtn.disabled = false;
      });
    });
  </script>

@endsection
