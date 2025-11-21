<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingSeeder extends Seeder
{
  public function run(): void
  {
    // Create 50 random bookings
    Booking::factory()->count(50)->create();

    // Optional: create a specific booking for testing
    Booking::factory()->create([
      'seat_number' => '1A',
      'status' => 'confirmed',
      'amount_paid' => 500.00,
      'payment_status' => 'paid',
    ]);
  }
}
