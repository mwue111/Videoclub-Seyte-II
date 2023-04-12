<h1>Editar película</h1>

<form action="{{ route('peliculas.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')
    <label for="title">Título de la película</label>
    <br>
    <input type="text" name="title" value="{{ $movie->title }}" />
    <br>
    <label for="oldPoster">Antiguo póster de la película</label>
    <br>
    <img src="{{ asset('storage/' . $movie->poster) }}" alt="Póster de la película {{$movie->title}}" style="width: 15%">
    <br>
    <label for="poster">Nuevo póster de la película</label>
    <br>
    <input type="file" name="poster" />
    <br>
    <label for="banner">Nuevo banner de la película</label>
    <br>
    <input type="file" name="banner" />
    <br>
    <label for="year">Año de la película</label>
    <br>
    <input type="number" name="year" value="{{ $movie->year }}" />
    <br>
    <label for="runtime">Duración de la película</label>
    <br>
    <input type="text" name="runtime" value="{{ $movie->runtime }}" />
    <br>
    <label for="plot">Sinopsis de la película</label>
    <br>
    <textarea type="text" name="plot">{{ $movie->plot }}</textarea>
    <br>
    <label for="director">Director de la película</label>
    <br>
    <input type="text" name="director" value="{{ $movie->director }}" />
    <br>
    <label for="file">Archivo de la película</label>
    <br>
    <input type="file" name="file"/>
    <br>
    <label for="file">Archivo de la trailer</label>
    <br>
    <input type="file" name="trailer"/>
    <br>
  <input type="submit" value="Guardar">

</form>


@foreach($genres as $genre)
<p>{{$genre->name}}</p>

@if ($genre->movies->contains($movie))
<form method="POST" action="{{route('peliculas.deleteGenre', $movie->id)}}">
  @csrf
  @method('DELETE')
  <input type="hidden" name="genre_id" value="{{$genre->id}}">
  <button>Eliminar</button>
</form>
@else
<form method="POST" action="{{route('peliculas.addGenre', $movie->id)}}">
  @csrf
  <input type="hidden" name="genre_id" value="{{$genre->id}}">
  <button>Añadir</button>
</form>
@endif

@endforeach

<br>
<a href=" {{ route('peliculas.index') }}">Volver</a>
