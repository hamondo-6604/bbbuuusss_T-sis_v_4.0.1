<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
  use HasFactory, SoftDeletes;

  // Mass assignable fields
  protected $fillable = [
    'user_id',
    'bus_id',
    'route_id',
    'trip_id',
    'seat_id',
    'seat_number',
    'status',
    'departure_time',
    'arrival_time',
    'amount_paid',
    'payment_status',
    'booking_reference',
    'cancelled_at',
  ];

  // Attribute casting
  protected $casts = [
    'departure_time' => 'datetime',
    'arrival_time' => 'datetime',
    'cancelled_at' => 'datetime',
    'amount_paid' => 'decimal:2',
  ];

  // ------------------------------------------------------------------
  // RELATIONSHIPS
  // ------------------------------------------------------------------

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function bus(): BelongsTo
  {
    return $this->belongsTo(Bus::class);
  }

  public function route(): BelongsTo
  {
    return $this->belongsTo(BusRoute::class);
  }

  public function trip(): BelongsTo
  {
    return $this->belongsTo(Trip::class);
  }

  public function seat(): BelongsTo
  {
    return $this->belongsTo(Seat::class);
  }

  // ------------------------------------------------------------------
  // BOOT & LIFECYCLE HOOKS
  // ------------------------------------------------------------------



  protected static function boot()
  {
    parent::boot();

    static::creating(function ($booking) {
      if (empty($booking->booking_reference)) {
        $booking->booking_reference = 'BKG-' . strtoupper(Str::random(8));
      }
    });
  }

  // ------------------------------------------------------------------
  // QUERY SCOPES
  // ------------------------------------------------------------------

  public function scopePending($query)
  {
    return $query->where('status', 'pending');
  }

  public function scopeConfirmed($query)
  {
    return $query->where('status', 'confirmed');
  }

  public function scopeCompleted($query)
  {
    return $query->where('status', 'completed');
  }

  public function scopeCancelled($query)
  {
    return $query->where('status', 'cancelled');
  }

  // ------------------------------------------------------------------
  // ACCESSORS
  // ------------------------------------------------------------------

  /**
   * Get the formatted amount paid for display.
   */
  public function getFormattedAmountPaidAttribute(): string
  {
    return number_format($this->amount_paid, 2);
  }

  /**
   * Get the effective seat type dynamically.
   * Falls back to seat or bus default if needed.
   */
  public function getEffectiveSeatTypeAttribute(): string
  {
    return $this->seat?->seat_type
      ?? $this->bus?->default_seat_type
      ?? 'economy';
  }
}
