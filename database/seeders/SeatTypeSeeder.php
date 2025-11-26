<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SeatType;

class SeatTypeSeeder extends Seeder
{
  public function run(): void
  {
    $types = [
      ['type_name'=>'Regular','default_fare_multiplier'=>1.0],
      ['type_name'=>'Premium','default_fare_multiplier'=>1.5],
      ['type_name'=>'Sleeper','default_fare_multiplier'=>2.0],
    ];

    foreach ($types as $type) {
      SeatType::create($type);
    }
  }
}

