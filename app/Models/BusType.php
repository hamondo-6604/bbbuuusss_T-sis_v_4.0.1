<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusType extends Model
{
  use HasFactory;
  protected $fillable = ['type_name','deck_type','description'];

  public function buses()
  {
    return $this->hasMany(Bus::class);
  }
}
