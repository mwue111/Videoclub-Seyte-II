<x-layout>

    <x-panel class="m-3">
    <h1 class="m-4 text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">Editar {{$movie->title}}</h1>
    <br>
    <form action="{{ route('peliculas.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <x-form.input name="title" label="Título de la película" :data="$movie->title" class="m-2" required/>

        <x-form.label name="oldPoster" class="mt-3">Antiguo póster de la película</x-form.label>
        <img src="{{ asset('storage/' . $movie->poster) }}" alt="Póster de la película {{$movie->title}}" style="width: 15%" name="oldPoster">

        <x-form.file name="poster" label="Nuevo póster de la película"/>

        <x-form.label name="oldBanner">Antiguo banner de la película</x-form.label>
        <img src="{{ asset('storage/' . $movie->banner) }}" alt="Banner de la película {{$movie->title}}" style="width: 15%" name="oldBanner">

        <x-form.file name="banner" label="Nuevo banner de la película"/>

        <x-form.number name="year" label="Año de la película" :data="$movie->year" required/>

        <x-form.number name="runtime" label="Duración de la película" :data="$movie->runtime" required/>

        <x-form.textarea name="plot" label="Sinopsis de la película" :data="$movie->plot" required/>

        <x-form.input name="director" label="Director/a de la película" :data="$movie->director" required/>

        <x-form.file name="file" label="Archivo de la película"/>

        <x-form.file name="trailer" label="Tráiler de la película"/>
        <br>
        <br>
        <x-form.button class="mb-4">Guardar</x-form.button>
        <br>
        <br>

    </form>

    <x-panel>

        <fieldset>
            <legend>Géneros</legend>
                @foreach($genres as $genre)
                    <x-form.label :name="$genre->name">{{$genre->name}}</x-form>

                    @if ($genre->movies->contains($movie))
                        <form method="POST" action="{{route('peliculas.deleteGenre', $movie->id)}}">
                        @csrf
                        @method('DELETE')
                            <input type="hidden" name="genre_id" value="{{$genre->id}}">
                            <x-form.button class="bg-danger">Eliminar</x-form.button>
                        </form>

                        @else
                        <form method="POST" action="{{route('peliculas.addGenre', $movie->id)}}">
                        @csrf
                            <input type="hidden" name="genre_id" value="{{$genre->id}}">
                            <x-form.button class="bg-success">Añadir</x-form.button>
                        </form>
                    @endif

                @endforeach
            </fieldset>
        </x-panel>
    </x-panel>
    <a href=" {{ route('peliculas.index') }}">Volver</a>
</x-layout>
