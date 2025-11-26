<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;

class CityFactory extends Factory
{
  protected $model = City::class;

  public function definition()
  {
    return [
      'name' => $this->faker->city,
      'state' => $this->faker->state,
      'country' => $this->faker->country,
      'timezone' => $this->faker->timezone,
    ];
  }
}
