<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Terminal;
use Illuminate\Support\Str;

class ScheduleSeeder extends Seeder
{
  public function run(): void
  {
    $buses = Bus::all();
    $routes = Route::all();
    $terminals = Terminal::all();

    foreach ($buses as $bus) {
      foreach ($routes as $route) {
        Schedule::create([
          'id' => (string) Str::uuid(),
          'bus_id' => $bus->id,
          'route_id' => $route->id,
          'departure_terminal_id' => $route->origin_terminal_id,
          'arrival_terminal_id' => $route->destination_terminal_id,
          'departure_time' => now()->addDays(rand(1,10)),
          'arrival_time' => now()->addDays(rand(11,20)),
          'status' => 'active',
        ]);
      }
    }
  }
}
