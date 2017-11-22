<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Room;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
      return view('home');
    }

    public function search(Request $request)
    {
      $city = $request->city;
      $from = $request->from;
      $to = $request->to;

      // verify that the hotels has rooms availables in all the date range
      // push in hotelResult only the hotels that have rooms available
      $hotels = Hotel::all()->where('city', $city);
      $hotelResult = [];

      foreach ($hotels as $hotel) {
        foreach ($hotel->rooms as $room) {
            $available = 0;
            while (strtotime($from) < strtotime($to)) {
              $from = date ("Y-m-d", strtotime("+1 day", strtotime($from)));
                foreach ($room->availabilityPrices as $availabilityPrice) {
                  if($availabilityPrice->date == $from &&
                  ($availabilityPrice->availability = "AVAILABLE" ||
                   $availabilityPrice->availability = "ON REQUEST" )) {
                    $available++;
                  }
                };
            }
            // if the available dates in the database are less than the range then it has no room available for the whole period
            if($available >= (strtotime($request->to) - strtotime($request->from))/86400) {
              array_push($hotelResult, $hotel);
            }
        };
      };

       return view('search')->with('hotels', $hotelResult)->with(['from' => $request->from, 'to' => $request->to]) ;
    }

    public function rooms(Request $request)
    {
      $hotel = $request->hotel;
      $from = $request->from;
      $to = $request->to;

      $hotel = Hotel::find($hotel);
      $roomResult = [];
      foreach ($hotel->rooms as $room) {
          $available = 0;
          while (strtotime($from) < strtotime($to)) {
            $from = date ("Y-m-d", strtotime("+1 day", strtotime($from)));
              foreach ($room->availabilityPrices as $availabilityPrice) {
                if($availabilityPrice->date == $from &&
                ($availabilityPrice->availability = "AVAILABLE" ||
                 $availabilityPrice->availability = "ON REQUEST" )) {
                  $available++;
                }
              };
          }
          // if the available dates in the database are less than the range then it has no room available for the whole period
          if($available >= (strtotime($request->to) - strtotime($request->from))/86400) {
            array_push($roomResult, $room);
          }
      };

       return view('rooms')->with('rooms', $roomResult)->with(['from' => $request->from, 'to' => $request->to]) ;
    }

    public function room(Request $request)
    {
      $room = $request->room;
      $from = $request->from;
      $to = $request->to;

      $room = Room::find($room);
      $availabilityResult = $room->availabilityPrices;

      return view('room')->with('availability', $availabilityResult)->with(['from' => $request->from, 'to' => $request->to]) ;
    }
}
