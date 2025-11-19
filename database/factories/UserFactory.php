<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
  protected $model = \App\Models\User::class;

  public function definition(): array
  {
    return [
      'name' => $this->faker->name(),
      'email' => $this->faker->unique()->safeEmail(),
      'phone' => $this->faker->optional()->phoneNumber(),
      'password' => bcrypt('password'), // default password for all seeded users
      'role' => $this->faker->randomElement(['admin', 'driver', 'customer']),
      'status' => $this->faker->randomElement(['active', 'blocked']),
      'email_verified_at' => now(),
      'remember_token' => Str::random(10),
    ];
  }

  /**
   * State for admin users.
   */
  public function admin(): static
  {
    return $this->state(fn () => [
      'role' => 'admin',
      'status' => 'active',
    ]);
  }

  /**
   * State for driver users.
   */
  public function driver(): static
  {
    return $this->state(fn () => [
      'role' => 'driver',
      'status' => 'active',
    ]);
  }

  /**
   * State for customer users.
   */
  public function customer(): static
  {
    return $this->state(fn () => [
      'role' => 'customer',
      'status' => 'active',
    ]);
  }
}
