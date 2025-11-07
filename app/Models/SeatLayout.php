<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatLayout extends Model
{
    use HasFactory;

    protected $fillable = [
        'layout_name',
        'total_rows',
        'total_columns',
        'capacity',
        'layout_map',
        'status',
        'description',
    ];

    protected $casts = [
        'layout_map' => 'array', // cast JSON to array
    ];

    // Relationships

    // A seat layout can have many bus types
    public function busTypes()
    {
        return $this->hasMany(\App\Models\BusType::class, 'seat_layout_id');
    }


    // A seat layout can also be assigned directly to buses
    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
