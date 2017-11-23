<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
     public function index()
     {
         return view('request');
     }

     public function store(Request $request)
     {
        $name = $request->name;
        $lastname = $request->lastname;
        $email = $request->email;
        $creditcard = $request->creditcard;

        $booking = new \App\Booking;
        $booking->name = $name;
        $booking->lastname = $lastname;
        $booking->email = $email;
        $booking->creditcard = $creditcard;
        $booking->price = 0;
        $booking->taxes = 0;
        $booking->fees = 0;
        $booking->total = 0;
        $booking->save();

        return redirect('/');
     }
}
