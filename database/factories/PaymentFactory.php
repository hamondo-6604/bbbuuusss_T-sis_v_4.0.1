<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Support\Str;

class PaymentFactory extends Factory
{
  protected $model = Payment::class;

  public function definition()
  {
    return [
      'id' => (string) Str::uuid(),
      'booking_id' => Booking::factory(),
      'amount' => $this->faker->numberBetween(100,1000),
      'payment_method' => $this->faker->randomElement(['card','upi','netbanking','wallet']),
      'status' => $this->faker->randomElement(['success','failed','pending']),
      'payment_date' => now(),
    ];
  }
}
