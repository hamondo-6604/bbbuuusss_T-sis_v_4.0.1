<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
  use HasFactory, SoftDeletes;

  // UUID primary key
  protected $keyType = 'string';
  public $incrementing = false;

  protected $fillable = [
    'user_type_id',
    'name',
    'email',
    'phone',
    'password',
    'status'
  ];

  // Automatically generate UUID when creating a user
  protected static function booted()
  {
    static::creating(function ($user) {
      // Generate UUID
      if (!$user->id) {
        $user->id = (string) Str::uuid();
      }

      // Hash password if not already hashed
      if (!empty($user->password_hash) && !Str::startsWith($user->password_hash, '$2y$')) {
        $user->password_hash = Hash::make($user->password_hash);
      }

      // Assign default user type if not provided
      if (!$user->user_type_id) {
        $defaultType = UserType::where('type_name', 'customer')->first();
        if ($defaultType) {
          $user->user_type_id = $defaultType->id;
        }
      }
    });
  }

  // Relationships
  public function userType()
  {
    return $this->belongsTo(UserType::class);
  }

  public function bookings()
  {
    return $this->hasMany(Booking::class);
  }
}
