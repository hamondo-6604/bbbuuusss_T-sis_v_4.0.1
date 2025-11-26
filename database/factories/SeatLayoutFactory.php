<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SeatLayout;

class SeatLayoutFactory extends Factory
{
  protected $model = SeatLayout::class;

  public function definition()
  {
    $totalSeats = $this->faker->numberBetween(20, 60);
    return [
      'layout_name' => 'Layout '.$this->faker->word,
      'total_seats' => $totalSeats,
      'deck_type' => $this->faker->randomElement(['single','double']),
      'description' => $this->faker->sentence,
    ];
  }
}

