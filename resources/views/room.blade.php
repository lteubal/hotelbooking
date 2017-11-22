@foreach ($availability as $ap)
  <hr>
  {{ $ap->date }} = {{ $ap->price }}  ({{ $ap->availability }})
@endforeach
