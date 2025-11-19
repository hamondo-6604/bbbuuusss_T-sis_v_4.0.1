<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
  use HasFactory;

  // Optional: if you want to allow mass assignment
  protected $fillable = ['name']; // add your columns here

  // Optional: explicitly set table name to avoid reserved word conflicts
  protected $table = 'routes';
}
