<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bus extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = [
    'bus_number',
    'seat_layout_id',
    'bus_type_id',
    'layout_id',
    'capacity',
    'status'
  ];

  public function busType()
  {
    return $this->belongsTo(BusType::class);
  }

  public function layout()
  {
    return $this->belongsTo(SeatLayout::class, 'seat_layout_id');
  }

  public function amenities()
  {
    return $this->belongsToMany(Amenity::class, 'bus_amenities');
  }

  public function schedules()
  {
    return $this->hasMany(Schedule::class);
  }
}
