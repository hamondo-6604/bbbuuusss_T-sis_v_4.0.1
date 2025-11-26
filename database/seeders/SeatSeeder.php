<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seat;
use App\Models\SeatLayout;
use App\Models\SeatType;

class SeatSeeder extends Seeder
{
  public function run(): void
  {
    $layouts = SeatLayout::all();
    $seatTypes = SeatType::all();

    foreach ($layouts as $layout) {
      $totalSeats = $layout->total_seats;

      for ($i = 1; $i <= $totalSeats; $i++) {
        Seat::create([
          'layout_id' => $layout->id,
          'seat_type_id' => $seatTypes->random()->id,
          'seat_number' => $i,
          'seat_position_row' => ceil($i / 4), // assuming 4 columns
          'seat_position_col' => ($i % 4 == 0 ? 4 : $i % 4),
          'status' => 'active',
          'gender_restriction' => 'none',
        ]);
      }
    }
  }
}
