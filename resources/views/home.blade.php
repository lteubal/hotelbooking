<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Booking</title>
    </head>
    <body>
      <form  action="{{ url('/search') }}" method="GET">
        {{ csrf_field() }}
        <input type="text" name="city" placeholder="Type a City...">
        <input type="date" name="from" placeholder="From Date...">
        <input type="date" name="to" placeholder="To Date...">

        <input type="submit" value="Search">
      </form>
    </body>
</html>
