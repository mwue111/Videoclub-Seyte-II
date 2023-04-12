<h1>{{$movie->title}}</h1>
<img src="{{ asset('storage/' . $movie->poster ) }}" alt="Poster de la película {{ $movie->title }}" style="width:10%"/>
<ul>
    <li>Año de salida: {{ $movie->year }}</li>
    <li>Duración: {{ $movie->runtime }}</li>
    <li>Género: {{ $movie->genre_id }}</li>
    <li>Director: {{ $movie->director }}</li>
</ul>
<p>{{$movie->plot}}</p>

<a href="{{ route('peliculas.index') }}">Volver</a>
