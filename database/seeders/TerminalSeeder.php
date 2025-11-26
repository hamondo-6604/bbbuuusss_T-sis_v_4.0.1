<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Terminal;
use App\Models\City;

class TerminalSeeder extends Seeder
{
  public function run(): void
  {
    $cities = City::all();

    foreach ($cities as $city) {
      Terminal::factory()->count(2)->create([
        'city_id' => $city->id
      ]);
    }
  }
}
