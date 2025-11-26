<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
  public function run(): void
  {
    $users = User::all();
    $schedules = Schedule::all();

    foreach ($users as $user) {
      $schedule = $schedules->random();
      Booking::create([
        'id' => (string) Str::uuid(),
        'user_id' => $user->id,
        'schedule_id' => $schedule->id,
        'booking_date' => now(),
        'status' => 'confirmed',
        'total_amount' => rand(100,1000),
      ]);
    }
  }
}
