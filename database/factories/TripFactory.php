<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BusRoute;
use App\Models\Bus;

class TripFactory extends Factory
{
  protected $model = \App\Models\Trip::class;

  public function definition(): array
  {
    $route = BusRoute::inRandomOrder()->first();
    $bus   = Bus::inRandomOrder()->first();

    $departure = $this->faker->time('H:i');
    $arrival   = date('H:i', strtotime($departure . ' +'.rand(1,5).' hours'));

    return [
      'route_id'        => $route ? $route->id : null,
      'bus_id'          => $bus ? $bus->id : null,
      'trip_code'       => strtoupper($this->faker->bothify('TRIP-###??')),
      'trip_date'       => $this->faker->dateTimeBetween('+1 days', '+30 days')->format('Y-m-d'),
      'departure_time'  => $departure,
      'arrival_time'    => $arrival,
      'available_seats' => $bus ? $bus->total_seats : 40,
      'fare'            => $this->faker->randomFloat(2, 50, 500),
      'is_active'       => $this->faker->boolean(90), // mostly active
    ];
  }
}
