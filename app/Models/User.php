<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  use HasFactory, SoftDeletes;

  protected $keyType = 'string';
  public $incrementing = false; // UUID
  protected $fillable = [
    'user_type_id','full_name','email','phone','password_hash','status'
  ];

  public function userType()
  {
    return $this->belongsTo(UserType::class);
  }

  public function bookings()
  {
    return $this->hasMany(Booking::class);
  }
}
