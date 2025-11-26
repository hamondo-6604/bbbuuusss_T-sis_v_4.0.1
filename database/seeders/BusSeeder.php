<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;
use App\Models\Amenity;

class BusSeeder extends Seeder
{
  public function run(): void
  {
    Bus::factory()->count(5)->create()->each(function($bus){
      // attach random amenities
      $amenityIds = Amenity::inRandomOrder()->take(rand(2,5))->pluck('id');
      $bus->amenities()->attach($amenityIds);
    });
  }
}
