@extends('layouts.app')

@section('content')
  <h1>Create New Booking</h1>

  <form action="{{ route('user.bookings.store') }}" method="POST">
    @csrf

    <label>Bus:</label>
    <select name="bus_id">
      @foreach($buses as $bus)
        <option value="{{ $bus->id }}">{{ $bus->name }}</option>
      @endforeach
    </select>
    <br><br>

    <label>Route:</label>
    <select name="route_id">
      @foreach($routes as $route)
        <option value="{{ $route->id }}">{{ $route->name ?? 'Route '.$route->id }}</option>
      @endforeach
    </select>
    <br><br>

    <label>Seat Number:</label>
    <input type="number" name="seat_number" min="1" required>
    <br><br>

    <button type="submit">Book Now</button>
  </form>


  <a href="{{ route('user.bookings.index') }}">Back to bookings</a>
@endsection
