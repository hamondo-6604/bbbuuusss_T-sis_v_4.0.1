<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $keyType = 'string';
  public $incrementing = false; // UUID primary key

  protected $fillable = [
    'bus_id',
    'route_id',
    'departure_terminal_id',
    'arrival_terminal_id',
    'departure_time',
    'arrival_time',
    'status'
  ];

  public function bus()
  {
    return $this->belongsTo(Bus::class);
  }

  public function route()
  {
    return $this->belongsTo(Route::class);
  }

  public function departureTerminal()
  {
    return $this->belongsTo(Terminal::class, 'departure_terminal_id');
  }

  public function arrivalTerminal()
  {
    return $this->belongsTo(Terminal::class, 'arrival_terminal_id');
  }

  public function bookings()
  {
    return $this->hasMany(Booking::class);
  }
}
