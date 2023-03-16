<h1>Editar película</h1>

<form action="{{ route('peliculas.update', $movie) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="title">Título de la película</label>
    <br>
    <input type="text" name="title" value="{{ $movie->title }}"/>
    <br>
    <label for="poster">Antiguo póster de la película</label>
    <br>
    <img src="{{ $movie->poster }}" alt="Póster de la película {{$movie->title}}" style="width: 20%">
    <br>
    <label for="poster">Nuevo póster de la película</label>
    <br>
    <input type="file" name="poster"/>
    <br>
    <label for="year">Año de la película</label>
    <br>
    <input type="number" name="year" value="{{ $movie->year }}"/>
    <br>
    <label for="runtime">Duración de la película</label>
    <br>
    <input type="text" name="runtime" value="{{ $movie->runtime }}"/>
    <br>
    <label for="plot">Sinopsis de la película</label>
    <br>
    <textarea type="text" name="plot">{{ $movie->plot }}</textarea>
    <br>
    <label for="genre">Género de la película</label>
    <br>
    <input type="text" name="genre" value="{{ $movie->genre }}"/>
    <br>
    <label for="director">Director de la película</label>
    <br>
    <input type="text" name="director" value="{{ $movie->director }}"/>
    <br>
    <input type="submit" value="Guardar">

</form>

<a href="{{ route('peliculas.index') }}">Volver</a>
