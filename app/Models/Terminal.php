<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
  use HasFactory;

  protected $fillable = ['city_id','name','code','address','latitude','longitude','contact_phone','is_active'];

  public function city()
  {
    return $this->belongsTo(City::class);
  }
}
