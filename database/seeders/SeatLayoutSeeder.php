<?php

namespace Database\Seeders;

use App\Models\SeatLayout;
use Illuminate\Database\Seeder;

class SeatLayoutSeeder extends Seeder
{
  public function run(): void
  {
    // 1️⃣ Create 5 random layouts safely
    for ($i = 0; $i < 5; $i++) {
      $layout = SeatLayout::factory()->make();

      SeatLayout::updateOrCreate(
        [
          'layout_name' => $layout->layout_name,
          'total_rows' => $layout->total_rows,
          'total_columns' => $layout->total_columns,
        ],
        $layout->toArray()
      );
    }

    // 2️⃣ Create Standard Coach 2x2 layout
    SeatLayout::updateOrCreate(
      [
        'layout_name' => 'Standard Coach 2x2',
        'total_rows' => 10,
        'total_columns' => 4,
      ],
      [
        'capacity' => 40,
        'description' => 'The default 2x2 seating arrangement for long-haul coaches.',
        'status' => 'active',
        'layout_map' => [
          'columns' => 4,
          'rows' => 10,
          'type' => '2x2 Standard',
        ],
      ]
    );

    // 3️⃣ Create VIP Sleeper layout using factory state
    $vipLayout = SeatLayout::factory()->vip()->make([
      'layout_name' => 'Sleeper Bus 1x1',
      'total_rows' => 10,
      'total_columns' => 2,
      'capacity' => 20,
      'description' => '1x1 sleeper berths on both sides of the aisle.',
    ]);

    SeatLayout::updateOrCreate(
      [
        'layout_name' => $vipLayout->layout_name,
        'total_rows' => $vipLayout->total_rows,
        'total_columns' => $vipLayout->total_columns,
      ],
      $vipLayout->toArray()
    );
  }
}
