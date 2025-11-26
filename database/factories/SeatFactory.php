<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Seat;
use App\Models\SeatLayout;
use App\Models\SeatType;

class SeatFactory extends Factory
{
  protected $model = Seat::class;

  public function definition()
  {
    return [
      'layout_id' => SeatLayout::factory(),
      'seat_type_id' => SeatType::factory(),
      'seat_number' => $this->faker->unique()->numberBetween(1,60),
      'seat_position_row' => $this->faker->numberBetween(1,10),
      'seat_position_col' => $this->faker->numberBetween(1,5),
      'status' => 'active',
      'gender_restriction' => 'none',
    ];
  }
}
