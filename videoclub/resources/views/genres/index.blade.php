@forelse($genres as $genre)
<a href="{{ route('generos.show', $genre->id) }}">{{$genre -> name}}</a>

@empty
<p>No hay géneros disponibles</p>
@endforelse

<a href="{{ route('peliculas.index') }}">Volver</a>
