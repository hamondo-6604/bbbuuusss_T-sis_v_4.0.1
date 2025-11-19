<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // <-- ADDED for type safety

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
    'seat_type',
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
    // Casting to float/decimal is generally safe, but Laravel's DB query will handle it.
    // Keeping it clean here. The `decimal:2` in migration is enough.
    'amount_paid' => 'decimal:2',
  ];

  // ------------------------------------------------------------------
  // RELATIONSHIPS (with type-hinting)
  // ------------------------------------------------------------------

  public function user(): BelongsTo // <-- Added BelongsTo return type
  {
    return $this->belongsTo(User::class);
  }

  public function bus(): BelongsTo // <-- Added BelongsTo return type
  {
    return $this->belongsTo(Bus::class);
  }

  public function route(): BelongsTo // <-- Added BelongsTo return type
  {
    return $this->belongsTo(Route::class);
  }

  public function trip(): BelongsTo // <-- Added BelongsTo return type
  {
    // trip_id is nullable in migration
    return $this->belongsTo(Trip::class);
  }

  public function seat(): BelongsTo // <-- Added BelongsTo return type
  {
    // seat_id is nullable in migration
    return $this->belongsTo(Seat::class);
  }

  // ------------------------------------------------------------------
  // BOOT & LIFECYCLE HOOKS
  // ------------------------------------------------------------------

  // Automatically generate unique booking_reference
  protected static function boot()
  {
    parent::boot();

    static::creating(function ($booking) {
      if (empty($booking->booking_reference)) {
        $booking->booking_reference = 'BKG-' . strtoupper(Str::random(8)); // Slightly modified prefix
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

  public function scopeConfirmed($query) // <-- Added Confirmed scope
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
  // ACCESSORS (Formatting for display)
  // ------------------------------------------------------------------

  /**
   * Get the formatted amount paid for display purposes.
   * NOTE: Do NOT use accessors for formatting unless explicitly necessary,
   * use Blade/helpers instead to avoid issues when retrieving the raw value.
   * This method ensures the raw decimal is used internally.
   */
  public function getFormattedAmountPaidAttribute(): string
  {
    // Returns a formatted string for views
    return number_format($this->amount_paid, 2);
  }
}
