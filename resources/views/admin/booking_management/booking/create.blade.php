@extends('layouts.app')

@section('title', 'Create Booking')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Create Booking</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.bookings.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1">User</label>
            <select name="user_id" class="w-full border p-2 rounded">
                <option value="">Select User</option>
                @foreach (\App\Models\User::all() as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Bus</label>
            <select name="bus_id" class="w-full border p-2 rounded">
                <option value="">Select Bus</option>
                @foreach (\App\Models\Bus::all() as $bus)
                    <option value="{{ $bus->id }}" {{ old('bus_id') == $bus->id ? 'selected' : '' }}>
                        {{ $bus->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Seat Number</label>
            <input type="text" name="seat_number" value="{{ old('seat_number') }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Seat Type</label>
            <select name="seat_type" class="w-full border p-2 rounded">
                <option value="economy" {{ old('seat_type') == 'economy' ? 'selected' : '' }}>Economy</option>
                <option value="business" {{ old('seat_type') == 'business' ? 'selected' : '' }}>Business</option>
            </select>
        </div>

        <div>
            <label class="block mb-1">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                @foreach (['pending','confirmed','cancelled','completed'] as $status)
                    <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Departure Time</label>
            <input type="datetime-local" name="departure_time" value="{{ old('departure_time') }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Arrival Time</label>
            <input type="datetime-local" name="arrival_time" value="{{ old('arrival_time') }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Amount Paid</label>
            <input type="number" step="0.01" name="amount_paid" value="{{ old('amount_paid') }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Payment Status</label>
            <select name="payment_status" class="w-full border p-2 rounded">
                <option value="unpaid" {{ old('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="paid" {{ old('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Create Booking</button>
        </div>
    </form>
</div>
@endsection
