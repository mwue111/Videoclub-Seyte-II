<h1>Añadir película</h1>

<form action="{{ route('peliculas.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="title">Título de la película</label>
    <br>
    <input type="text" name="title"/>
    <br>
    <label for="poster">Póster de la película</label>
    <br>
    <input type="file" name="poster"/>
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
    <label for="file">Archivo de la película</label>
    <br>
    <input type="file" name="file"/>
    <br>
    <input type="submit" value="Añadir">

@if($errors->any())
    <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
    </ul>
@endif
</form>

<a href="{{ route('peliculas.index') }}">Volver</a>
