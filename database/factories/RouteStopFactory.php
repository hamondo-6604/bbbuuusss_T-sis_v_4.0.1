<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RouteStop;
use App\Models\Route;
use App\Models\Stop;

class RouteStopFactory extends Factory
{
  protected $model = RouteStop::class;

  public function definition()
  {
    return [
      'route_id' => Route::factory(),
      'stop_id' => Stop::factory(),
      'stop_order' => $this->faker->numberBetween(1,5),
      'distance_from_origin' => $this->faker->numberBetween(10,100),
      'estimated_time_min' => $this->faker->numberBetween(10,120),
      'is_active' => true,
    ];
  }
}
