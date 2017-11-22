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
        Hotel: {{ $hotel->name }} <br>
        address: {{ $hotel->address1 }} <br>
        Phone: {{ $hotel->phone }} <br>
        <hr>
      @endforeach
    </body>
</html>
