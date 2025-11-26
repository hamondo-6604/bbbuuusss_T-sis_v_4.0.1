<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stop;
use App\Models\City;

class StopSeeder extends Seeder
{
  public function run(): void
  {
    $cities = City::all();

    foreach ($cities as $city) {
      Stop::factory()->count(5)->create([
        'city_id' => $city->id
      ]);
    }
  }
}
