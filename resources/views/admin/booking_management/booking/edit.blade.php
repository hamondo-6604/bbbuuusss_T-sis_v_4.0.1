@extends('layouts.app')

@section('title', 'Edit Booking')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Booking</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-800 p-3 mb-4 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Seat Number</label>
            <input type="text" name="seat_number" value="{{ old('seat_number', $booking->seat_number) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Seat Type</label>
            <select name="seat_type" class="w-full border p-2 rounded">
                @foreach (['economy','business'] as $type)
                    <option value="{{ $type }}" {{ old('seat_type', $booking->seat_type) == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Status</label>
            <select name="status" class="w-full border p-2 rounded">
                @foreach (['pending','confirmed','cancelled','completed'] as $status)
                    <option value="{{ $status }}" {{ old('status', $booking->status) == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block mb-1">Departure Time</label>
            <input type="datetime-local" name="departure_time" value="{{ old('departure_time', $booking->departure_time?->format('Y-m-d\TH:i')) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Arrival Time</label>
            <input type="datetime-local" name="arrival_time" value="{{ old('arrival_time', $booking->arrival_time?->format('Y-m-d\TH:i')) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Amount Paid</label>
            <input type="number" step="0.01" name="amount_paid" value="{{ old('amount_paid', $booking->amount_paid) }}" class="w-full border p-2 rounded">
        </div>

        <div>
            <label class="block mb-1">Payment Status</label>
            <select name="payment_status" class="w-full border p-2 rounded">
                <option value="unpaid" {{ old('payment_status', $booking->payment_status) == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                <option value="paid" {{ old('payment_status', $booking->payment_status) == 'paid' ? 'selected' : '' }}>Paid</option>
            </select>
        </div>

        <div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update Booking</button>
        </div>
    </form>
</div>
@endsection
