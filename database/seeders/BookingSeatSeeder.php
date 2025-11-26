<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Seat;
use App\Models\BookingSeat;

class BookingSeatSeeder extends Seeder
{
  public function run(): void
  {
    $bookings = Booking::all();

    foreach ($bookings as $booking) {
      $seats = Seat::inRandomOrder()->take(rand(1,3))->pluck('id');
      foreach ($seats as $seatId) {
        BookingSeat::create([
          'booking_id' => $booking->id,
          'seat_id' => $seatId,
          'status' => 'booked',
        ]);
      }
    }
  }
}
