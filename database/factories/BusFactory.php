<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Bus;
use App\Models\BusType;
use App\Models\SeatLayout;

class BusFactory extends Factory
{
    protected $model = Bus::class;

    public function definition()
    {
        return [
            'bus_number' => strtoupper($this->faker->bothify('??###')),
            'bus_name' => $this->faker->company, // ✅ Add bus_name
            'bus_type_id' => BusType::factory(),
            'seat_layout_id' => SeatLayout::factory(),
            'capacity' => $this->faker->numberBetween(20,60),
            'status' => 'active',
        ];
    }
}
