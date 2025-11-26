<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BusType;

class BusTypeFactory extends Factory
{
  protected $model = BusType::class;

  public function definition()
  {
    return [
      'type_name' => $this->faker->unique()->word,
      'deck_type' => $this->faker->randomElement(['single','double']),
      'description' => $this->faker->sentence,
    ];
  }
}
