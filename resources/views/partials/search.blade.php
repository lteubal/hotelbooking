<div class="search">
  <span>Hotel Booking</span>
  <form  action="{{ url('/search') }}" method="GET">
    {{ csrf_field() }}
    <input type="text" name="city" placeholder="Search City or Hotel ..." >
    <input type="date" name="from" placeholder="From Date..." required>
    <input type="date" name="to" placeholder="To Date..." required>

    <input type="submit" value="Search">
  </form>
</div>
<hr>
