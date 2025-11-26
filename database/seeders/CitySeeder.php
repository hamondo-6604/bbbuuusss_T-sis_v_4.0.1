<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
  public function run(): void
  {
    City::factory()->count(5)->create();
  }
}
