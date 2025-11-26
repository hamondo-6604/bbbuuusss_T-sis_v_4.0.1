<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Stop;
use App\Models\City;

class StopFactory extends Factory
{
  protected $model = Stop::class;

  public function definition()
  {
    return [
      'name' => $this->faker->streetName,
      'city_id' => City::factory(),
      'code' => strtoupper($this->faker->lexify('???')),
      'latitude' => $this->faker->latitude,
      'longitude' => $this->faker->longitude,
      'is_terminal' => false,
      'is_active' => true,
    ];
  }
}
