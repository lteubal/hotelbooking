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

  public function hotels()
  {
  return $this->belongsTo(Hotel::class);
  }

  public static function available($hotel_id, $from, $to)
  {
  return AvailabilityPrice::where('date','>=', $from)
  ->where('date','<=', $to)
  ->where('availability', '!=', 'SOLD OUT')
  ->where('hotel_id', '=', $hotel_id)
  ->orderBy('price')
  ->get()
  ;
  }
}
