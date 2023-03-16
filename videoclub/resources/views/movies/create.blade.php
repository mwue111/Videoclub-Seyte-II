<form action="{{ route('peliculas.store') }}" method="POST">
    @csrf

    <label for="title">Título de la película</label>
    <br>
    <input type="text" name="title"/>
    <br>
    <label for="year">Año de la película</label>
    <br>
    <input type="number" name="year"/>
    <br>
    <label for="runtime">Duración de la película</label>
    <br>
    <input type="text" name="runtime"/>
    <br>
    <label for="plot">Sinopsis de la película</label>
    <br>
    <textarea type="text" name="plot"></textarea>
    <br>
    <label for="genre">Género de la película</label>
    <br>
    <input type="text" name="genre"/>
    <br>
    <label for="director">Director de la película</label>
    <br>
    <input type="text" name="director"/>
    <br>
    <input type="submit" value="Añadir">

</form>

<a href="{{ route('peliculas.index') }}">Volver</a>
