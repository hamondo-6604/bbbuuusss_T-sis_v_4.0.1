<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stop extends Model
{

  use HasFactory;
  protected $fillable = ['name','city_id','code','latitude','longitude','is_terminal','is_active'];

  public function city()
  {
    return $this->belongsTo(City::class);
  }

  public function routeStops()
  {
    return $this->hasMany(RouteStop::class);
  }
}
