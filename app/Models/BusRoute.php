<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusRoute extends Model
{
  use HasFactory;

  protected $table = 'routes';

  protected $fillable = [
    'route_name',
    'origin',
    'destination',
    'distance_km',
    'status',
    'description',
  ];

  // A route can have many trips
  public function trips()
  {
    return $this->hasMany(Trip::class);
  }
}
