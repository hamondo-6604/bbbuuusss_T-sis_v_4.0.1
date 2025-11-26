<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
  protected $fillable = ['layout_id','seat_type_id','seat_number','seat_position_row','seat_position_col','status','gender_restriction'];

  public function layout()
  {
    return $this->belongsTo(SeatLayout::class, 'layout_id');
  }

  public function seatType()
  {
    return $this->belongsTo(SeatType::class, 'seat_type_id');
  }

  public function bookings()
  {
    return $this->belongsToMany(Booking::class, 'booking_seats')->withPivot('status');
  }

  public function layoutMap()
  {
    return $this->hasOne(LayoutMap::class);
  }
}
