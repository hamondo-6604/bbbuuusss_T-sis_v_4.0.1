<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeatLayout extends Model
{
  use HasFactory;
  protected $fillable = ['layout_name','total_seats','deck_type','description'];

  public function seats()
  {
    return $this->hasMany(Seat::class, 'layout_id');
  }

  public function layoutMap()
  {
    return $this->hasMany(LayoutMap::class, 'layout_id');
  }

  public function buses()
  {
    return $this->hasMany(Bus::class);
  }
}
