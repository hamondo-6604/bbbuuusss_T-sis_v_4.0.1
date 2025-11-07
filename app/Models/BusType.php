<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
        'seat_layout_id',
        'status',
        'description',
    ];

    // Relationships
    

    // BusType belongs to SeatLayout
    public function seatLayout()
{
    return $this->belongsTo(\App\Models\SeatLayout::class, 'seat_layout_id');
}


    // BusType has many buses
    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
