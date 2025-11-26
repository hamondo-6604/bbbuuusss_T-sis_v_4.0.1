<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitySeeder extends Seeder
{
  public function run(): void
  {
    $amenities = ['WiFi','AC','Charging Port','Toilet','Blanket','Water Bottle'];

    foreach ($amenities as $amenity) {
      Amenity::create(['name'=>$amenity]);
    }
  }
}
