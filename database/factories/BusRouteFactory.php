<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BusRouteFactory extends Factory
{
  protected $model = \App\Models\BusRoute::class;

  public function definition(): array
  {
    $origin = $this->faker->city;
    $destination = $this->faker->city;

    // Ensure origin != destination
    while ($destination === $origin) {
      $destination = $this->faker->city;
    }

    return [
      'route_name'   => "$origin → $destination",
      'origin'       => $origin,
      'destination'  => $destination,
      'distance_km'  => $this->faker->numberBetween(10, 500),
      'status'       => $this->faker->randomElement(['active', 'inactive']),
      'description'  => $this->faker->sentence(),
    ];
  }
}
