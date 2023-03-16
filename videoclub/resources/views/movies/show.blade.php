<h1>{{$movie->title}}</h1>
<ul>
    <li>Año de salida: {{ $movie->year }}</li>
    <li>Duración: {{ $movie->runtime }}</li>
    <li>Género: {{ $movie->genre }}</li>
    <li>Director: {{ $movie->director }}</li>
</ul>
<p>{{$movie->plot}}</p>

<a href="{{ route('peliculas.index') }}">Volver</a>
