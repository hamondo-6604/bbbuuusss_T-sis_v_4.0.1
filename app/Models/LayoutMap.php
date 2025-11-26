<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LayoutMap extends Model
{
  protected $table = 'layout_map';
  protected $fillable = ['layout_id','seat_id','row_num','col_num','is_aisle','is_disabled'];

  public function layout()
  {
    return $this->belongsTo(SeatLayout::class);
  }

  public function seat()
  {
    return $this->belongsTo(Seat::class);
  }
}
