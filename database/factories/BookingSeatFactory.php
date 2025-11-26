<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BookingSeat;
use App\Models\Booking;
use App\Models\Seat;

class BookingSeatFactory extends Factory
{
  protected $model = BookingSeat::class;

  public function definition()
  {
    return [
      'booking_id' => Booking::factory(),
      'seat_id' => Seat::factory(),
      'status' => $this->faker->randomElement(['booked','cancelled']),
    ];
  }
}
