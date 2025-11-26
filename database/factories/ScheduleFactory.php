<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Schedule;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Terminal;
use Illuminate\Support\Str;

class ScheduleFactory extends Factory
{
  protected $model = Schedule::class;

  public function definition()
  {
    return [
      'id' => (string) Str::uuid(),
      'bus_id' => Bus::factory(),
      'route_id' => Route::factory(),
      'departure_terminal_id' => Terminal::factory(),
      'arrival_terminal_id' => Terminal::factory(),
      'departure_time' => $this->faker->dateTimeBetween('+1 days', '+7 days'),
      'arrival_time' => $this->faker->dateTimeBetween('+8 days', '+14 days'),
      'status' => 'active',
    ];
  }
}
