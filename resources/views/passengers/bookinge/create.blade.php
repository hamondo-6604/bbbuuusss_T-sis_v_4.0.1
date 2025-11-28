@extends('layouts.app')

@section('content')
  <div class="max-w-3xl mx-auto py-10">

    <h2 class="text-3xl font-bold mb-6 text-gray-800">Create a Booking</h2>

    <div class="bg-white shadow rounded-lg p-6">

      <form action="{{ route('user.bookings.storeRouteDate') }}" method="POST">
        @csrf

        {{-- From Location --}}
        <div class="mb-4">
          <label class="block font-medium mb-2">From</label>
          <select name="origin" required class="w-full border rounded px-3 py-2">
            <option value="">Select departure location</option>
            @foreach($origins as $origin)
              <option value="{{ $origin }}">{{ $origin }}</option>
            @endforeach
          </select>
        </div>

        {{-- To Location --}}
        <div class="mb-4">
          <label class="block font-medium mb-2">To</label>
          <select name="destination" required class="w-full border rounded px-3 py-2">
            <option value="">Select arrival location</option>
            @foreach($destinations as $destination)
              <option value="{{ $destination }}">{{ $destination }}</option>
            @endforeach
          </select>
        </div>

        {{-- Travel Date --}}
        <div class="mb-4">
          <label class="block font-medium mb-2">Travel Date</label>
          <input type="date" name="travel_date" required class="w-full border rounded px-3 py-2" min="{{ date('Y-m-d') }}">
        </div>

        {{-- Bus Type (Optional) --}}
        <div class="mb-4">
          <label class="block font-medium mb-2">Bus Type (Optional)</label>
          <select name="bus_type" class="w-full border rounded px-3 py-2">
            <option value="">Any</option>
            <option value="AC">AC</option>
            <option value="Express">Express</option>
            <option value="Standard">Standard</option>
          </select>
        </div>

        <button type="submit" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold">
          Search Trips
        </button>

      </form>

    </div>

  </div>
@endsection
