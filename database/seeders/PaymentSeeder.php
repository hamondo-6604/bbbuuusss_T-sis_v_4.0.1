<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
  public function run(): void
  {
    $bookings = Booking::all();

    foreach ($bookings as $booking) {
      Payment::create([
        'id' => (string) Str::uuid(),
        'booking_id' => $booking->id,
        'amount' => $booking->total_amount,
        'payment_method' => 'card',
        'status' => 'success',
        'payment_date' => now(),
      ]);
    }
  }
}
