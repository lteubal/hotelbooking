<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
  // Hotel __has_many__ Room
  public function rooms()
  {
    return $this->hasMany(Room::class);
  }
}
