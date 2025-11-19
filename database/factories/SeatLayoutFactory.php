<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SeatLayout;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SeatLayout>
 */
class SeatLayoutFactory extends Factory
{
  protected $model = SeatLayout::class;

  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    $columns = $this->faker->randomElement([2, 3, 4, 5, 6]);
    $rows = $this->faker->numberBetween(8, 15);
    $capacity = $rows * $columns;

    $layoutName = match ($columns) {
      4 => "Standard 2x2 Layout ({$capacity} seats)",
      5 => "Coach 2x3 Layout ({$capacity} seats)",
      6 => "Double Decker Layout ({$capacity} seats)",
      2, 3 => "Custom Layout ({$capacity} seats)",
      default => "Custom Layout ({$capacity} seats)",
    };

    return [
      'layout_name' => $layoutName,
      'total_rows' => $rows,
      'total_columns' => $columns,
      'capacity' => $capacity,
      'status' => $this->faker->randomElement(['active', 'inactive']),
      'description' => $this->faker->optional()->sentence(8),
      'layout_map' => [
        'columns' => $columns,
        'rows' => $rows,
        'type' => 'Standard Seating',
      ],
    ];
  }

  /**
   * VIP 1x1 layout state
   */
  public function vip(): Factory
  {
    $rows = $this->faker->numberBetween(5, 10);
    $columns = 2;
    $capacity = $rows * $columns;

    return $this->state(fn (array $attributes) => [
      'layout_name' => "VIP 1x1 Recliner Layout ({$rows} rows)",
      'total_rows' => $rows,
      'total_columns' => $columns,
      'capacity' => $capacity,
      'description' => 'Spacious, premium single-seat layout.',
      'status' => 'active',
      'layout_map' => [
        'columns' => $columns,
        'rows' => $rows,
        'type' => 'VIP 1x1',
      ],
    ]);
  }
}
