<x-layout>
    <h1>Editar película</h1>

    <x-panel>
    <form action="{{ route('peliculas.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <!-- <label for="title">Título de la película</label>
        <br> -->

        <x-form.input name="title" label="Título de la película" :data="$movie" required/>
          <!-- <input type="text" name="title" value="{{ $movie->title }}" required/> -->
          <br>

          <!-- <label for="oldPoster">Antiguo póster de la película</label> -->
          <x-form.label name="oldPoster">Antiguo póster de la película</x-form.label>

          <img src="{{ asset('storage/' . $movie->poster) }}" alt="Póster de la película {{$movie->title}}" style="width: 15%" name="oldPoster">
          <br>

          <!-- <label for="poster">Nuevo póster de la película</label> -->
          <x-form.label name="poster">Nuevo póster de la película</x-form.label>
          <br>
          <input type="file" name="poster"/>
          <br>

          <!-- <label for="banner">Nuevo banner de la película</label> -->
          <x-form.label name="banner">Nuevo banner de la película</x-form.label>
          <br>

          <input type="file" name="banner"/>
          <br>

          <!-- <label for="year">Año de la película</label> -->
          <x-form.label name="year">Año de la película</x-form.label>
          <br>

          <input type="number" name="year" value="{{ $movie->year }}" required/>
          <br>

          <!-- <label for="runtime">Duración de la película</label> -->
          <x-form.label name="runtime">Duración de la película</x-form.label>
          <br>
          <input type="number" name="runtime" value="{{ $movie->runtime }}" required/>
          <br>

          <!-- <label for="plot">Sinopsis de la película</label> -->
          <x-form.label name="plot">Sinopsis de la película</x-form.label>

          <br>
          <textarea type="text" name="plot" required>{{ $movie->plot }}</textarea>
          <br>

          <!-- <label for="director">Director de la película</label> -->
          <x-form.label name="director">Director de la película</x-form.label>
          <br>
          <input type="text" name="director" value="{{ $movie->director }}" required/>
          <br>

          <!-- <label for="file">Archivo de la película</label> -->
          <x-form.label name="file">Archivo de la película</x-form.label>
          <br>

          <input type="file" name="file"/>
          <br>

          <!-- <label for="trailer">Archivo de la película</label> -->
          <x-form.label name="trailer">Archivo de la película</x-form.label>
          <br>
          <input type="file" name="trailer"/>
          <br>
        <input type="submit" value="Guardar">
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

        <x-panel>

            <fieldset>
                <legend>Géneros</legend>
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
            </fieldset>
        </x-panel>
    </x-panel>
    <a href=" {{ route('peliculas.index') }}">Volver</a>
</x-layout>
