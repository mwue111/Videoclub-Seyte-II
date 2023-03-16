<h1>{{$movie->title}}</h1>
<img src="{{ $movie->poster }}" alt="Poster de la película {{ $movie->title }}">
<ul>
    <li>Año de salida: {{ $movie->year }}</li>
    <li>Duración: {{ $movie->runtime }}</li>
    <li>Género: {{ $movie->genre }}</li>
    <li>Director: {{ $movie->director }}</li>
</ul>
<p>{{$movie->plot}}</p>

<a href="{{ route('peliculas.index') }}">Volver</a>
