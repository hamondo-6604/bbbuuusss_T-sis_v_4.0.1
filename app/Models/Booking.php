<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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
        'amount_paid' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }

    // Automatically generate unique booking_reference
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($booking) {
            if (empty($booking->booking_reference)) {
                $booking->booking_reference = strtoupper(Str::random(10));
            }
        });
    }

    // Query scopes for easy filtering
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    // Accessors
    public function getAmountPaidAttribute($value)
    {
        return number_format($value, 2);
    }
}
