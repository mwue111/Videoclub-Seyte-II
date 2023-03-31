<h1>Editar película</h1>

<form action="{{ route('peliculas.update', $movie) }}" method="POST" enctype="multipart/form-data">
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
  <input type="submit" value="Guardar">

</form>

@foreach($genres as $genre)
<p value="{{$genre->id}}">{{$genre->name}}</p>
@endforeach
<a href="{{ route('peliculas.index') }}">Volver</a>