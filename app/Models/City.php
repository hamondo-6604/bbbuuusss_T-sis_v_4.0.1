<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
  use HasFactory;

  protected $fillable = ['name','state','country','timezone'];

  public function terminals()
  {
    return $this->hasMany(Terminal::class);
  }

  public function stops()
  {
    return $this->hasMany(Stop::class);
  }
}
