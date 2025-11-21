<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BusType;
use App\Models\SeatLayout;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bus>
 */
class BusFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    // Get a random BusType with an associated SeatLayout (optional fallback if none)
    $busType = BusType::whereNotNull('seat_layout_id')->inRandomOrder()->first();

    // If no BusType with seat_layout_id, fallback to any busType and any seatLayout
    if (!$busType) {
      $busType = BusType::inRandomOrder()->first();
    }

    $seatLayoutId = $busType?->seat_layout_id ?? SeatLayout::inRandomOrder()->value('id');

    // If seatLayoutId is null (very unlikely if you seeded seat_layouts), fallback again
    if (!$seatLayoutId) {
      $seatLayoutId = SeatLayout::inRandomOrder()->value('id');
    }

    return [
      'bus_number' => strtoupper($this->faker->bothify('BUS-###??')),
      'bus_name' => $this->faker->company . ' ' . $this->faker->word(),
      'bus_type_id' => $busType->id ?? BusType::factory(),
      'seat_layout_id' => $seatLayoutId,
      'total_seats' => SeatLayout::find($seatLayoutId)?->capacity ?? $this->faker->numberBetween(20, 50),
      'default_seat_type' => $this->faker->randomElement(['economy', 'business', 'vip']),
      'bus_img' => null,
      'status' => $this->faker->randomElement(['active', 'inactive', 'maintenance']),
      'description' => $this->faker->optional()->sentence(12),
    ];
  }
}
