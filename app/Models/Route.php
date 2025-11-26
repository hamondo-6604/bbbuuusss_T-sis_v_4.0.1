<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
  protected $fillable = [
    'origin_terminal_id',
    'destination_terminal_id',
    'via',
    'distance_km',
    'duration_min',
    'is_active'
  ];

  public function originTerminal()
  {
    return $this->belongsTo(Terminal::class, 'origin_terminal_id');
  }

  public function destinationTerminal()
  {
    return $this->belongsTo(Terminal::class, 'destination_terminal_id');
  }

  public function routeStops()
  {
    return $this->hasMany(RouteStop::class);
  }

  public function schedules()
  {
    return $this->hasMany(Schedule::class);
  }
}
