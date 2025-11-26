<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatType extends Model
{
  protected $fillable = ['type_name','description','default_fare_multiplier'];

  public function seats()
  {
    return $this->hasMany(Seat::class);
  }
}
