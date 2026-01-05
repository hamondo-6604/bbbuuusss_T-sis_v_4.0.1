<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserType;

class UserTypeFactory extends Factory
{
  protected $model = UserType::class;

  public function definition()
  {
    $types = ['Admin','Customer','Staff','Driver'];

    return [
      'type_name' => $this->faker->unique()->randomElement($types),
      'description' => $this->faker->sentence,
      // is_default is handled by model booted(), no need to set here
    ];
  }
}
