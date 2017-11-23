<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Search Log</title>
  </head>
  <body>
    Lasts Search Terms:
    <ul>
    @foreach($searchTerms as $searchTerm)
        <li>{{ $searchTerm->search }} </li>
    @endforeach
    </ul>
  </body>
</html>
