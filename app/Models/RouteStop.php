<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteStop extends Model
{
  protected $fillable = [
    'route_id',
    'stop_id',
    'stop_order',
    'distance_from_origin',
    'estimated_time_min',
    'is_active'
  ];

  public function route()
  {
    return $this->belongsTo(Route::class);
  }

  public function stop()
  {
    return $this->belongsTo(Stop::class);
  }
}
