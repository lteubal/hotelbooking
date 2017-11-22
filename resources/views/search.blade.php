<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Booking</title>
    </head>
    <body>
      SEARCH <br><br>
      @foreach ($hotels as $hotel)
        <img src="{{ asset('images/' . $hotel->picture) }}" alt="{{ $hotel->name }}"> <br>
        Hotel: {{ $hotel->name }} <br>
        address: {{ $hotel->address1 }}, {{ $hotel->city }}, {{ $hotel->state }}, {{ $hotel->country }} <br>
        Stars: {{ $hotel->stars }} <br>
       <form  action="{{ url('/rooms') }}" method="GET">
        {{ csrf_field() }}
        <input type="hidden" name="hotel" value="{{ $hotel->id }}">
        <input type="hidden" name="from"  value="{{ $from }}" >
        <input type="hidden" name="to"  value="{{ $to }}" >

        <input type="submit" value="Rooms">
      </form>
        <hr>
      @endforeach
    </body>
</html>
