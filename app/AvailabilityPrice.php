<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailabilityPrice extends Model
{
  // AvailabilityPrice __belongs_to__ Room
  public function room()
  {
  return $this->belongsTo(Room::class);
  }
}
