<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- ADD THIS

class User extends Authenticatable
{
  use HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
    'role',
    'status',
    'phone',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'email_verified_at' => 'datetime',
    'password' => 'hashed',
  ];

  /**
   * Check if the user is an admin.
   *
   * @return bool
   */
  public function isAdmin(): bool
  {
    return $this->role === 'admin';
  }

  /**
   * Check if the user is a driver.
   *
   * @return bool
   */
  public function isDriver(): bool
  {
    return $this->role === 'driver';
  }

  /**
   * Check if the user is a customer.
   *
   * @return bool
   */
  public function isCustomer(): bool
  {
    return $this->role === 'customer';
  }

  // ------------------------------------------------------------------
  // ELOQUENT RELATIONSHIPS
  // ------------------------------------------------------------------

  /**
   * Get the bookings associated with the user.
   * A User has many Bookings (One-to-Many relationship).
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function bookings(): HasMany // <-- ADD THIS METHOD
  {
    // Assumes the Booking model exists at App\Models\Booking
    // and the 'bookings' table has a 'user_id' foreign key.
    return $this->hasMany(Booking::class);
  }
}
