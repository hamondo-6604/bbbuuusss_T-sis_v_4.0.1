<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
  use HasFactory;

  protected $fillable = [
    'route_id',
    'bus_id',
    'trip_code',
    'trip_date',
    'departure_time',
    'arrival_time',
    'available_seats',
    'fare',
    'is_active',
  ];

  protected $casts = [
    'trip_date' => 'date',            // converts to Carbon instance
    'departure_time' => 'datetime:H:i',
    'arrival_time' => 'datetime:H:i',
    'is_active' => 'boolean',         // true/false
  ];

  // Relationships
  public function route()
  {
    return $this->belongsTo(BusRoute::class);
  }

  public function bus()
  {
    return $this->belongsTo(Bus::class);
  }
}
