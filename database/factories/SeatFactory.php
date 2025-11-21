<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Seat;
use App\Models\Bus;

class SeatFactory extends Factory
{
  protected $model = Seat::class;

  public function definition(): array
  {
    $bus = Bus::inRandomOrder()->first(); // Pick a bus to assign

    // Decide seat type: inherit from bus or random for hybrid
    $seatType = $this->faker->boolean(80)
      ? $bus->default_seat_type   // 80% inherit from bus
      : $this->faker->randomElement(['economy', 'business', 'vip']); // 20% override

    return [
      'bus_id' => $bus->id,
      'seat_number' => strtoupper($this->faker->bothify('??-#')), // e.g., A-1, B-2
      'seat_type' => $seatType,
      'status' => 'available',
    ];
  }

  /**
   * Optionally force all seats to a single type
   */
  public function singleType(string $type): Factory
  {
    return $this->state(fn() => ['seat_type' => $type]);
  }
}
