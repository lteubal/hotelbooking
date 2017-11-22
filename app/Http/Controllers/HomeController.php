<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Room;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $from;
    private $to;

    public function index()
    {
      return view('home');
    }

    public function search(Request $request)
    {
      $city = $request->city;
      $from = $request->from;
      $to = $request->to;

      // filter only hotels with the city searched or that contain in the city the letters searched (if empty show all)
      $hotels = Hotel::where('city', 'LIKE', '%'.$city.'%')->get();

      // verify that the hotels has rooms available in all the date range
      // push in hotelResult only the hotels that have rooms available
      $hotelResult =  $this->hotelsAvailable($hotels, $from, $to);


       return view('search')->with('hotels', $hotelResult)->with(['from' => $request->from, 'to' => $request->to]) ;
    }

    public function rooms(Request $request)
    {
       $from = $request->from;
       $to = $request->to;
       $hotel = Hotel::find($request->hotel);

       $roomResult = $this->roomsAvailable($hotel, $from, $to);
       return response()->json($roomResult, 200);

      //  return view('rooms')->with('rooms', $roomResult)->with(['from' => $request->from, 'to' => $request->to]) ;
    }

    public function room(Request $request)
    {
      $av = [];
      $room = $request->room;
      $from = $request->from;
      $to = $request->to;

      $this->from = $from;
      $this->to = $to;

      $room = Room::find($room) ;
      $availabilityResult = $room->availabilityPrices;
      $availabilityResult = $availabilityResult->filter(
        function ($availability) {

          return $availability->date >= $this->from && $availability->date <= $this->to ;
      });
      foreach ($availabilityResult as $availability) {
          array_push($av, $availability);
      };

       return response()->json($av, 200);
    }

    // Helper that returns array with rooms available for one hotel in a date range
    private function roomsAvailable($hotel, $from, $to)
    {
      $currentDate = $from;
      $roomResult = [];
      foreach ($hotel->rooms as $room) {
          $available = 0;
          while (strtotime($currentDate) < strtotime($to)) {
            $currentDate = date ("Y-m-d", strtotime("+1 day", strtotime($currentDate)));
              foreach ($room->availabilityPrices as $availabilityPrice) {
                if($availabilityPrice->date == $currentDate &&
                ($availabilityPrice->availability = "AVAILABLE" ||
                 $availabilityPrice->availability = "ON REQUEST" )) {
                  $available++;
                }
              };
          }
          // if the available dates in the database are less than the range then it has no room available for the whole period
          if($available >= (strtotime($to) - strtotime($from))/86400) {
            array_push($roomResult, $room);
          }
      };
      return $roomResult;
    }
    //  Helper that returns array with hotels with rooms available in all the date range
    private function hotelsAvailable($hotels, $from, $to)
    {
      $hotelResult = [];
      foreach ($hotels as $hotel) {
        if( $this->roomsAvailable($hotel, $from, $to)){
          array_push($hotelResult, $hotel);
        }
      };
      return $hotelResult;
    }
}
