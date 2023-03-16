
@forelse($movies as $movie)
    <p>{{ $movie->title }}</p>

@empty
    <p>No hay películas aún.</p>

@endforelse

<a href="{{ route('peliculas.create') }}">Añadir película</a>
