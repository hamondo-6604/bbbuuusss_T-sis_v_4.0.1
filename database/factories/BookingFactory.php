<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Support\Str;

class BookingFactory extends Factory
{
  protected $model = Booking::class;

  public function definition()
  {
    return [
      'id' => (string) Str::uuid(),
      'user_id' => User::factory(),
      'schedule_id' => Schedule::factory(),
      'booking_date' => now(),
      'status' => $this->faker->randomElement(['confirmed','pending','cancelled']),
      'total_amount' => $this->faker->numberBetween(100,1000),
    ];
  }
}

