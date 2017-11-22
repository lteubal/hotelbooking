SEARCH
<form  action="{{ url('/search') }}" method="GET">
  {{ csrf_field() }}
  <input type="text" name="city" placeholder="Type a City...">
  <input type="date" name="from" placeholder="From Date...">
  <input type="date" name="to" placeholder="To Date...">

  <input type="submit" value="Search">
</form>
<hr>
<br>
