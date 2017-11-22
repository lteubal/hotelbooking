@foreach ($rooms as $room)
  <hr>
  room type: {{ $room->room_type }} {{ $room->room_view }}<br>
  occupancy: {{ $room->occupancy }} <br>
  conditions: {{ $room->conditions }} <br>
  cancellation policy: {{ $room->cancellation_policy }} <br>
  <form  action="{{ url('/room') }}" method="GET">
   {{ csrf_field() }}
   <input type="hidden" name="room" value="{{ $room->id }}">
   <input type="hidden" name="from"  value="{{ $from }}" >
   <input type="hidden" name="to"  value="{{ $to }}" >

   <input type="submit" value="Details">
 </form>
@endforeach
