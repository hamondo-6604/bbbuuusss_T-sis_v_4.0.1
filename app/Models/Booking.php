<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
  use HasFactory, HasUuids, SoftDeletes;

  /**
   * UUID primary key
   */
  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'user_id',
    'schedule_id',
    'booking_date',
    'status',
    'total_amount',
  ];

  protected $casts = [
    'booking_date' => 'datetime',
    'total_amount' => 'decimal:2',
  ];

  protected $attributes = [
    'status' => 'pending',
  ];

  /**
   * Relationships
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function schedule()
  {
    return $this->belongsTo(Schedule::class);
  }
}
