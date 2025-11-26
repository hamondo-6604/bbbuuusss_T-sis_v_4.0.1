<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserType;

class UserTypeFactory extends Factory
{
  protected $model = UserType::class;

  public function definition()
  {
    return [
      'type_name' => $this->faker->unique()->randomElement(['Admin','Customer','Staff','Driver']),
      'description' => $this->faker->sentence,
    ];
  }
}
