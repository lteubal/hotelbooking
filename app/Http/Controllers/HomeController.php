<?php

namespace App\Http\Controllers;

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
      return view('search', $request); 
    }
}
