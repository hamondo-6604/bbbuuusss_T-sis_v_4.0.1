<?php


namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Terminal;
use App\Models\City;

class TerminalFactory extends Factory
{
  protected $model = Terminal::class;

  public function definition()
  {
    return [
      'city_id' => City::factory(),
      'name' => $this->faker->company . ' Terminal',
      'code' => strtoupper($this->faker->lexify('???')),
      'address' => $this->faker->address,
      'latitude' => $this->faker->latitude,
      'longitude' => $this->faker->longitude,
      'contact_phone' => $this->faker->phoneNumber,
      'is_active' => true,
    ];
  }
}
