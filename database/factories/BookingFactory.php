<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\User;
use App\Models\Bus;
use App\Models\BusRoute;
use App\Models\Trip;
use App\Models\Seat;

class BookingFactory extends Factory
{
  protected $model = Booking::class;

  public function definition(): array
  {
    $user = User::inRandomOrder()->first();
    $bus = Bus::inRandomOrder()->first();
    $route = BusRoute::inRandomOrder()->first();

    // Ensure these exist
    if (!$user || !$bus || !$route) {
      throw new \Exception('Cannot create booking: missing User, Bus, or Route records.');
    }

    // Select a random trip and seat
    $trip = Trip::where('bus_id', $bus->id)
      ->where('route_id', $route->id)
      ->inRandomOrder()
      ->first();

    $seat = Seat::where('bus_id', $bus->id)
      ->inRandomOrder()
      ->first();

    return [
      'user_id' => $user->id,
      'bus_id' => $bus->id,
      'route_id' => $route->id,
      'trip_id' => $trip?->id,
      'seat_id' => $seat?->id,
      'seat_number' => $seat?->seat_number ?? $this->faker->numberBetween(1, 50),
      'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled', 'completed']),
      'departure_time' => $this->faker->dateTimeBetween('+1 days', '+10 days'),
      'arrival_time' => $this->faker->dateTimeBetween('+11 days', '+20 days'),
      'amount_paid' => $this->faker->randomFloat(2, 100, 1000),
      'payment_status' => $this->faker->randomElement(['unpaid', 'paid', 'refunded']),
      'cancelled_at' => null,
    ];
  }
}
