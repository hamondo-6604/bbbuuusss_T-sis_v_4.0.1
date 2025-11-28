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

  protected $hidden = [
    'password',
    'remember_token'
  ];

  protected static function booted()
  {
    static::creating(function ($user) {
      if (!$user->id) {
        $user->id = (string) Str::uuid();
      }

      if (!empty($user->password) && !Str::startsWith($user->password, '$2y$')) {
        $user->password = Hash::make($user->password);
      }

      if (!$user->user_type_id) {
        $defaultType = UserType::where('is_default', true)->first();
        if ($defaultType) {
          $user->user_type_id = $defaultType->id;
        }
      }
    });

    static::updating(function ($user) {
      if ($user->isDirty('password') && !Str::startsWith($user->password, '$2y$')) {
        $user->password = Hash::make($user->password);
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

  // Accessors
  public function getRoleAttribute()
  {
    return $this->userType ? $this->userType->type_name : null;
  }

  public function getStatusBadgeAttribute()
  {
    return match($this->status) {
      'active' => '<span class="badge bg-success">Active</span>',
      'inactive' => '<span class="badge bg-secondary">Inactive</span>',
      'banned' => '<span class="badge bg-danger">Banned</span>',
      default => '<span class="badge bg-light text-dark">Unknown</span>',
    };
  }
}
