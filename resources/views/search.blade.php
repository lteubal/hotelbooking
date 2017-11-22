@extends('layout')

@section('body')
  @include('partials.search')
  @foreach ($hotels as $hotel)
    <img src="{{ asset('images/' . $hotel->picture) }}" alt="{{ $hotel->name }}"> <br>
    Hotel: {{ $hotel->name }} <br>
    address: {{ $hotel->address1 }}, {{ $hotel->city }}, {{ $hotel->state }}, {{ $hotel->country }} <br>
    Stars: {{ $hotel->stars }} <br>
    <form  action="{{ url('/room') }}" method="GET">
      {{ csrf_field() }}
      <input type="hidden" name="room" value="1">
      <input type="hidden" name="from"  value="{{ $from }}" >
      <input type="hidden" name="to"  value="{{ $to }}" >
      <input type="submit" value="Rooms">
    </form>
    <script>
       let cond = "";
       let canc = "";

       function getRooms(){
         $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

         $.ajax({
                type:'GET',
                url:'/rooms',
                data:
               {
                   hotel: '{{ $hotel->id }}',
                   from: '{{ $from }}',
                   to: '{{ $to }}',
               },
                success:function(data){

                   $("#roomlist").toggle();
                   $("#roomlist").html("");
                   for(let i = 0; i < data.length; i++) {
                     $("#roomlist").append( data[i].room_type );
                     $("#roomlist").append( data[i].room_view );
                     $("#roomlist").append( data[i].occupancy );

                     $("#roomlist").append( `<button onclick="getRoom( ${data[i].id})">Details</button>` );
                     $("#roomlist").append( `<div id="roomdetail${data[i].id}" style="display:none">` );
                     cond = data[i].conditions;
                     canc = data[i].cancellation_policy;
                     $("#roomlist").append( "</div>" );

                 }
                }
             });
          }

          function getRoom(room){
            $.ajax({
                   type:'GET',
                   url:'/room',
                   data:
                  {
                      room: room,
                      from: '{{ $from }}',
                      to: '{{ $to }}',
                  },
                   success:function(data){

                      $("#roomdetail"+room).toggle();
                      $("#roomdetail"+room).html("");
                      $("#roomdetail"+room).append( cond );
                      $("#roomdetail"+room).append( canc );
                      $("#roomdetail"+room).append( "<br>" );
                      for(let i = 0; i < data.length; i++) {
                        $("#roomdetail"+room).append( data[i].date );
                        $("#roomdetail"+room).append( data[i].price );
                        $("#roomdetail"+room).append( data[i].availability );
                        $("#roomdetail"+room).append( "<hr>" );
                      }
                   }
                });
           } ;
    </script>

    <button onclick="getRooms()">Rooms</button>

    @include('rooms')

  @endforeach
@stop
