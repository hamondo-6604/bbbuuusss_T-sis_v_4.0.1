<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Route;
use App\Models\Terminal;

class RouteFactory extends Factory
{
  protected $model = Route::class;

  public function definition()
  {
    return [
      'origin_terminal_id' => Terminal::factory(),
      'destination_terminal_id' => Terminal::factory(),
      'via' => $this->faker->sentence(3),
      'distance_km' => $this->faker->numberBetween(50,500),
      'duration_min' => $this->faker->numberBetween(60,600),
      'is_active' => true,
    ];
  }
}
