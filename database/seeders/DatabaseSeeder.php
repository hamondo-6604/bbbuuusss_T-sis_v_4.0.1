<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    DB::transaction(function () {
      // 1️⃣ Seed Seat Layouts first (needed by bus types)
      $this->call(SeatLayoutSeeder::class);

      // 2️⃣ Seed Bus Types (depends on seat layouts)
      $this->call(BusTypeSeeder::class);

      // 3️⃣ Seed Buses (depends on bus types and seat layouts)
      $this->call(BusSeeder::class);

      // 4️⃣ Seed Seats for each bus (depends on buses)
      $this->call(SeatSeeder::class);

      // 5️⃣ Seed Users (admins, customers, etc.)
      $this->call(UserSeeder::class);

      // 6️⃣ Seed Routes (needed before trips)
      $this->call(BusRouteSeeder::class);

      // 7️⃣ Seed Trips (depends on buses and routes)
      $this->call(TripSeeder::class);

      // 8️⃣ Seed Bookings (depends on trips and users)
      $this->call(BookingSeeder::class);
    });
  }
}
