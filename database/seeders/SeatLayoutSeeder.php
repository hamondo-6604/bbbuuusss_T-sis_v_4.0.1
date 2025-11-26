<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeatLayout;

class SeatLayoutSeeder extends Seeder
{
  public function run(): void
  {
    SeatLayout::factory()->count(3)->create();
  }
}
