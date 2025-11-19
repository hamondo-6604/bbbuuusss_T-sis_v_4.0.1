<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SeatLayout; // Import the SeatLayout model

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusType>
 */
class BusTypeFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'type_name' => $this->faker->randomElement([
        'Mini Bus',
        'Coach',
        'Double Decker',
        'Luxury Bus',
        'Sleeper Bus',
      ]),

      // Assign a random existing seat layout id from the seat_layouts table
      'seat_layout_id' => SeatLayout::inRandomOrder()->value('id'),

      'status' => $this->faker->randomElement([
        'active',
        'inactive',
      ]),

      'description' => $this->faker->optional()->sentence(10),
    ];
  }
}
