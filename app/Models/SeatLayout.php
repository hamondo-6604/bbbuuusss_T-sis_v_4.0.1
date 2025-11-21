<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SeatLayout extends Model
{
  use HasFactory;

  protected $fillable = [
    'layout_name',
    'total_rows',
    'total_columns',
    'capacity',
    'layout_map',
    'status',
    'description',
  ];

  protected $casts = [
    'layout_map' => 'array', // cast JSON to array
  ];

  // ------------------------------------------------------------------
  // RELATIONSHIPS
  // ------------------------------------------------------------------

  /**
   * A seat layout can have many bus types.
   */
  public function busTypes(): HasMany
  {
    return $this->hasMany(\App\Models\BusType::class, 'seat_layout_id');
  }

  /**
   * A seat layout can be assigned directly to buses.
   */
  public function buses(): HasMany
  {
    return $this->hasMany(Bus::class, 'seat_layout_id');
  }

  // ------------------------------------------------------------------
  // ACCESSORS & HELPERS
  // ------------------------------------------------------------------

  /**
   * Get the effective capacity of the layout.
   * If `capacity` is null, calculate as total_rows * total_columns
   */
  public function getEffectiveCapacityAttribute(): int
  {
    return $this->capacity ?? ($this->total_rows * $this->total_columns);
  }
}
