<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BusRoute;

class BusRouteSeeder extends Seeder
{
  public function run(): void
  {
    BusRoute::factory()->count(10)->create();
  }
}
