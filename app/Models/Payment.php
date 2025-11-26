<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
  use SoftDeletes;

  protected $keyType = 'string';
  public $incrementing = false; // UUID primary key

  protected $fillable = [
    'booking_id',
    'amount',
    'payment_method',
    'status',
    'payment_date'
  ];

  public function booking()
  {
    return $this->belongsTo(Booking::class);
  }
}
