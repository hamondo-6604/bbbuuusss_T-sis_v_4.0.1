<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    // Core entities
    $this->call([
      UserTypeSeeder::class,
      CitySeeder::class,
      TerminalSeeder::class,
      StopSeeder::class,
      BusTypeSeeder::class,
      SeatTypeSeeder::class,
      SeatLayoutSeeder::class,
      SeatSeeder::class,  // <-- here
      AmenitySeeder::class,
    ]);


    // Dependent entities
    $this->call([
      BusSeeder::class,
      RouteSeeder::class,
      RouteStopSeeder::class,
      ScheduleSeeder::class,
      UserSeeder::class,
      BookingSeeder::class,
      BookingSeatSeeder::class,
      PaymentSeeder::class,
    ]);
  }
}
