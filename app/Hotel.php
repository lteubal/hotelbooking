<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
  // Hotel __has_many__ Room
  public function rooms()
  {
    return $this->hasMany(Room::class)->orderBy('room_type', 'asc');
  }
  public function availabilityPrices()
  {
    return $this->hasMany(AvailabilityPrice::class) ;
  }
  public function minPrice($from, $to)
  {
    $result = $this->availabilityPrices()
    ->orderBy('price')
    ->where('date','>=', $from)
    ->where('date','<=', $to)
    ->where('availability', '!=', 'SOLD OUT')
    ->first()
    ->price;
  return $result;
  }
}
