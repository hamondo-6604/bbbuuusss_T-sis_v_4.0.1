<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
  protected $model = User::class;

  public function definition()
  {
    return [
      'id' => (string) Str::uuid(),
      'user_type_id' => 1, // assign Admin by default, can be updated
      'name' => $this->faker->name,
      'email' => $this->faker->unique()->safeEmail,
      'phone' => $this->faker->unique()->phoneNumber,
      'password' => bcrypt('password'),
      'status' => 'active',
    ];
  }
}
