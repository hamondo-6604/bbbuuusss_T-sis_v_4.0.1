<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;
use App\Models\Stop;
use App\Models\RouteStop;

class RouteStopSeeder extends Seeder
{
  public function run(): void
  {
    $routes = Route::all();
    $stops = Stop::all();

    foreach ($routes as $route) {
      $stopSample = $stops->random(rand(2,4));
      $order = 1;
      foreach ($stopSample as $stop) {
        RouteStop::create([
          'route_id' => $route->id,
          'stop_id' => $stop->id,
          'stop_order' => $order++,
          'distance_from_origin' => rand(5,100),
          'estimated_time_min' => rand(10,120),
          'is_active' => true,
        ]);
      }
    }
  }
}
