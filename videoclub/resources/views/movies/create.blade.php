<form action="{{ route('peliculas.store') }}" method="POST">
    @csrf

    <label for="title">Título de la película</label>
    <input type="text" name="title"/>
    <br>
    <label for="year">Año de la película</label>
    <input type="number" name="year"/>
    <br>
    <label for="runtime">Duración de la película</label>
    <input type="text" name="title"/>
    <br>
    <label for="plot">Sinopses de la película</label>
    <input type="text" name="title"/>
    <br>
    <label for="genre">Género de la película</label>
    <input type="text" name="title"/>
    <br>
    <label for="director">Director de la película</label>
    <input type="text" name="title"/>
    <br>
    <input type="submit" value="Añadir">

</form>

<a href="{{ route('peliculas.index') }}">Volver</a>
