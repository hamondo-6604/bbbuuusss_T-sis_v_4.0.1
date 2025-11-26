<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Route;
use App\Models\Terminal;

class RouteSeeder extends Seeder
{
  public function run(): void
  {
    $terminals = Terminal::pluck('id')->toArray();

    $routes = [];

    foreach ($terminals as $origin) {
      foreach ($terminals as $destination) {
        if ($origin !== $destination) {
          $routes[] = [
            'origin_terminal_id' => $origin,
            'destination_terminal_id' => $destination,
            'via' => null,
            'distance_km' => rand(50, 500),
            'duration_min' => rand(60, 600),
            'is_active' => 1,
            'created_at' => now(),
            'updated_at' => now(),
          ];
        }
      }
    }

    Route::insert($routes);

  }
}
