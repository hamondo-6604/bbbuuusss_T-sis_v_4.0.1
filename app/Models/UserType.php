<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
  protected $fillable = ['type_name', 'description', 'is_default'];

  protected static function booted()
  {
    // Ensure "customer" is always default
    static::creating(function ($userType) {
      if ($userType->type_name === 'customer') {
        $userType->is_default = true;
      } else {
        $userType->is_default = false;
      }
    });
  }

  // Relation to users
  public function users()
  {
    return $this->hasMany(User::class);
  }
}
