<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusType;

class BusTypeSeeder extends Seeder
{
  public function run(): void
  {
    BusType::factory()->count(3)->create();
  }
}
