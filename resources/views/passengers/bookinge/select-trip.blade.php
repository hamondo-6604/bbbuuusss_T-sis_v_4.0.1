@extends('layouts.app')

@section('content')
  <div class="max-w-5xl mx-auto py-10">

    <h2 class="text-2xl font-bold mb-6 text-gray-800">
      Route Options: {{ $from }} → {{ $to }} on {{ $selectedDate }}
    </h2>

    {{-- Direct Trips --}}
    @if($trips->isNotEmpty())
      <h3 class="text-xl font-semibold mb-4 text-gray-700">Direct Buses</h3>
      @foreach($trips as $trip)
        <div class="bg-white shadow rounded-lg p-5 mb-4 flex justify-between items-center">
          <div>
            <h4 class="text-lg font-semibold">{{ $trip->bus->name }}</h4>
            <p class="text-gray-600">{{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}
              → {{ \Carbon\Carbon::parse($trip->arrival_time)->format('H:i') }}</p>
            <p class="text-sm text-gray-500">
              Seats Available: <strong>{{ $trip->availableSeats() }}</strong> |
              Fare: ${{ number_format($trip->fare, 2) }}
            </p>
          </div>
          <a href="{{ route('user.bookings.selectSeats', $trip->id) }}"
             class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Select Seats
          </a>
        </div>
      @endforeach
    @endif

    {{-- Alternative / Connecting Buses --}}
    @if($upcomingTrips->isNotEmpty())
      <h3 class="text-xl font-semibold mt-8 mb-4 text-gray-700">Alternative Options</h3>
      @foreach($upcomingTrips as $trip)
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4 flex justify-between items-center">
          <div>
            <h4 class="text-lg font-semibold">{{ $trip->bus->name }}</h4>
            <p class="text-gray-600">{{ \Carbon\Carbon::parse($trip->departure_time)->format('H:i') }}
              → {{ \Carbon\Carbon::parse($trip->arrival_time)->format('H:i') }}</p>
            <p class="text-sm text-gray-500">
              Seats Available: <strong>{{ $trip->availableSeats() }}</strong> |
              Fare: ${{ number_format($trip->fare, 2) }}
            </p>
            <p class="text-sm text-gray-500 italic">Upcoming trip / connecting option</p>
          </div>
          <a href="{{ route('user.bookings.selectSeats', $trip->id) }}"
             class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
            Select Seats
          </a>
        </div>
      @endforeach
    @endif

    {{-- No Trips Found --}}
    @if($trips->isEmpty() && $upcomingTrips->isEmpty())
      <div class="text-center text-gray-500 py-10">
        No trips available for this route & date.
      </div>
    @endif

  </div>
@endsection
