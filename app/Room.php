<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
// Room __belongs_to__ Hotel
  public function hotel()
  {
  return $this->belongsTo(Hotel::class);
  }
  // Room __has_many__ AvailabilityPrice
  public function availabilityPrices()
  {
    return $this->hasMany(AvailabilityPrice::class);
  }
}
