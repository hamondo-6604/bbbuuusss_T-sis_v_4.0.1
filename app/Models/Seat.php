<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
  use HasFactory;

  // Fillable fields
  protected $fillable = [
    'bus_id',
    'seat_number',
    'seat_type',
    'status',
  ];

  /**
   * Relationship: Seat belongs to a Bus
   */
  public function bus()
  {
    return $this->belongsTo(Bus::class);
  }

  /**
   * Relationship: Seat has many Bookings
   */
  public function bookings()
  {
    return $this->hasMany(Booking::class);
  }

  /**
   * Get the effective seat type.
   * If seat_type is null, inherit from the bus default_seat_type.
   */
  public function getEffectiveSeatTypeAttribute()
  {
    return $this->seat_type ?? $this->bus->default_seat_type ?? 'economy';
  }
}
