<x-layout>
    <h1>Añadir película</h1>

    <form action="{{ route('peliculas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="title">Título de la película</label>
        <br>
        <input type="text" name="title" required/>
        <br>
        <label for="poster">Póster de la película</label>
        <br>
        <input type="file" name="poster" required/>
        <br>
        <label for="banner">Banner de la película</label>
        <br>
        <input type="file" name="banner" required/>
        <br>
        <label for="year">Año de la película</label>
        <br>
        <input type="number" name="year" required/>
        <br>
        <label for="runtime">Duración de la película</label>
        <br>
        <input type="number" name="runtime" required/>
        <br>
        <label for="plot">Sinopsis de la película</label>
        <br>
        <textarea type="text" name="plot" required></textarea>
        <br>
        <label for="genre">Género de la película</label>
        <br>
        <select name="genre_id" id="genre_id" required>
        @foreach($genres as $genre)
            <option value="{{$genre->id}}">{{$genre->name}}</option>
        @endforeach
        </select>
        <br>
        <label for="director">Director de la película</label>
        <br>
        <input type="text" name="director" required/>
        <br>
        <label for="file">Archivo de la película</label>
        <br>
        <input type="file" name="file" required/>
        <br>
        <label for="file">Archivo de la trailer</label>
        <br>
        <input type="file" name="trailer" required/>
        <br>
        <input type="submit" value="Añadir">

    @isset($errors)
        @if($errors->any())
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
    @endisset
    </form>

    <a href="{{ route('peliculas.index') }}">Volver</a>
</x-layout>
