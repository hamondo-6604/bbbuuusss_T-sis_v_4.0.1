<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_number',
        'bus_name',
        'bus_type_id',
        'seat_layout_id',
        'total_seats',
        'bus_img',
        'status',
        'description',
    ];

    // Relationships

    // Bus belongs to BusType
    public function type()
    {
        return $this->belongsTo(BusType::class, 'bus_type_id');
    }

    // Bus belongs to SeatLayout
    public function seatLayout()
    {
        return $this->belongsTo(SeatLayout::class, 'seat_layout_id');
    }
}
