@extends('layout')

@section('body')
  @include('partials.search')
  @foreach ($hotels as $hotel)
    <div class="container">
      <div class="hotel">
        <img src="{{ asset('images/' . $hotel->picture) }}" alt="{{ $hotel->name }}">
        <div class="name">
          {{ $hotel->name }}
        </div>

         <div class="stars">
           @for($i=1; $i<=$hotel->stars; $i++)
             <span class="fa fa-star checked"></span>
           @endfor
           @for($i=$hotel->stars; $i<5; $i++)
             <span class="fa fa-star"></span>
           @endfor
         </div>
         <div class="address">
           {{ $hotel->address1 }}, {{ $hotel->city }}, {{ $hotel->state }}, {{ $hotel->country }}
         </div>
         <div class="price">
           <span class="starting">starting at</span>
           <span class="usd">USD</span><span class="amount" id="amount">{{ $hotel->minPrice($from, $to)}} </span>
           <span class="perroom">per room / night</span>
            <span class="taxes">*Taxes not included</span>
         </div>


      <script>
         let cond = "";
         let canc = "";
         let ocup = "";

         function getRooms(hotel){

           $.ajaxSetup({
              headers:
              { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
          });

           $.ajax({
                  type:'GET',
                  url:'/rooms',
                  data:
                 {
                     hotel: hotel,
                     from: '{{ $from }}',
                     to: '{{ $to }}',
                 },
                  success:function(data){
                      $("#roomlist"+hotel).toggle();
                      $("#roomlist"+hotel).html("");
                      for(let i = 0; i < data.length; i++) {

                         $("#roomlist"+hotel).append( "<div class='roomrow'>" );
                         $("#roomlist"+hotel).append( "<div class='roomtype'>" + data[i].room_type + " " + data[i].room_view + "</div>"  );
                         $("#roomlist"+hotel).append( "<span class='roomav'>" + data[i].availability_prices[0].availability  + "</span> ");

                         $("#roomlist"+hotel).append( "<span class='roomprice'>" + data[i].availability_prices[0].price  + "</span> ");
                         $("#roomlist"+hotel).append( "<span class='roompricedetail'> USD Per Night</span> ");
                         $("#roomlist"+hotel).append( "<span class='request'> REQUEST</span> ");
                         $("#roomlist"+hotel).append( `<span class='details' onclick="getRoom( ${data[i].id})"><i class="fa fa-caret-down" aria-hidden="true"></i> Details</span>` );
                         $("#roomlist"+hotel).append( `<div id="roomdetail${data[i].id}" class="roomdetail" style="display:none">` );
                         $("#roomlist"+hotel).append( "</div>" );
                         cond = data[i].conditions;
                         canc = data[i].cancellation_policy;
                         ocup = data[i].occupancy;
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
                        $("#roomdetail"+room).append("<div class='ocup'>" );
                        for(let i=1; i<=ocup; i++) {
                          $("#roomdetail"+room).append( "<span class='fa fa-user'></span>");
                        }
                        $("#roomdetail"+room).append( "</div>");
                        subtotal = 0;
                         for(let i = 0; i < data.length; i++) {
                          $("#roomdetail"+room).append( "<div class='pricesblock'>");
                          $("#roomdetail"+room).append( "<div class='da'>");
                          $("#roomdetail"+room).append( data[i].date );
                          $("#roomdetail"+room).append( "</div>");
                          $("#roomdetail"+room).append( "<div class='pr'>");
                          $("#roomdetail"+room).append( data[i].price );
                          $("#roomdetail"+room).append( "</div>");
                          $("#roomdetail"+room).append( "</div>");
                          subtotal +=   Number(data[i].price);
                        }
                        taxes = 0.07 * subtotal;
                        fees = 0;
                        total = subtotal + taxes + fees;
                        $("#roomdetail"+room).append( "<hr>" );

                        $("#roomdetail"+room).append("<span class='cond'> Conditions and Offers </span><br>");
                        $("#roomdetail"+room).append("<span class='cond2'>. "+ cond + "</span><br>");
                        $("#roomdetail"+room).append("<span class='cond'> Cancellation Policy  </span><br>");
                        $("#roomdetail"+room).append("<span class='cond2'>. "+canc + "</span><br>");

                        $("#roomdetail"+room).append("<div class='total'> <span class='cond'> Price:"+ subtotal +" USD</span><br><span class='cond'> Taxes 7%: "+ taxes + " USD</span><br><span class='cond'> Fees: "+ fees + " USD</span><br><span class='cond'> Total: "+ total + " USD</span><br></div></div>");


                     }
                  });
             } ;


      </script>


    </div>
    <span class="button"><button onclick="getRooms({{ $hotel->id }})"><i class="fa fa-caret-down" aria-hidden="true"></i> Rooms / Availability</button></span>
    <div id="roomlist{{ $hotel->id }}" class="roomlist" style="display:none"></div>

    </div>



  @endforeach


@stop
