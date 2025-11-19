<?php

namespace Database\Seeders;

use App\Models\BusType;
use App\Models\SeatLayout;
use Illuminate\Database\Seeder;

class BusTypeSeeder extends Seeder
{
public function run(): void
{
// Ensure you have some seat layouts to link
$layouts = SeatLayout::all();

if ($layouts->isEmpty()) {
// Create default layouts if none exist
SeatLayout::factory()->count(3)->create();
$layouts = SeatLayout::all();
}

// Create 5 bus types with random seat layouts linked
BusType::factory(5)->create([
'seat_layout_id' => $layouts->random()->id,
]);

// Create specific bus types with linked seat layouts
BusType::factory()->create([
'type_name' => 'Express Coach',
'status' => 'active',
'description' => 'Comfortable express coach',
'seat_layout_id' => $layouts->random()->id,
]);

BusType::factory()->create([
'type_name' => 'City Mini Bus',
'status' => 'active',
'description' => 'Compact express',
'seat_layout_id' => $layouts->random()->id,
]);
}
}
