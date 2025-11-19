<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;

class BusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Create 10 random buses
    Bus::factory(10)->create();

    // Optionally create some specific buses
    Bus::factory()->create([
      'bus_number' => 'BUS-001A',
      'bus_name' => 'City Express',
      'status' => 'active',
      // you can also specify bus_type_id and seat_layout_id here if you want fixed relations
    ]);

    Bus::factory()->create([
      'bus_number' => 'BUS-002B',
      'bus_name' => 'Luxury Cruiser',
      'status' => 'active',
    ]);
  }
}
