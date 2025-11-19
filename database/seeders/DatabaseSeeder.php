<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    // 1. Seat layouts must be seeded first
    $this->call(SeatLayoutSeeder::class);

    // 2. Bus types (depends on seat layouts)
    $this->call(BusTypeSeeder::class);

    // 3. Buses (depends on bus types and seat layouts)
    $this->call(BusSeeder::class);

    // Optional: Users, Routes, etc.
    $this->call(UserSeeder::class);
  }
}
