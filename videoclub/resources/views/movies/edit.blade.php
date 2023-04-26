<x-layout>

    <h1 class="m-3 text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">Editar {{$movie->title}}</h1>
    <x-panel class="m-3 flex">
        <x-panel class="w-full float-left">
            <form action="{{ route('peliculas.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <x-form.input name="title" label="Título de la película" :data="$movie->title" required/>

                @if(!empty($movie->poster))
                    @php
                        $poster_path = public_path('storage/' . $movie->poster);
                    @endphp

                    @if(file_exists($poster_path))
                        <x-form.image name="oldPoster" class="mt-3" label="Antiguo póster de la película" :data="$movie->poster" :movie="$movie->title"/>
                    @endif
                @endif

                <x-form.file name="poster" label="Nuevo póster de la película" class="mt-4"/>

                @if(!empty($movie->banner))
                    @php
                        $banner_path = public_path('storage/' . $movie->banner);
                    @endphp

                    @if(file_exists($banner_path))
                        <x-form.image name="oldBanner" class="mt-3" label="Antiguo banner de la película" :data="$movie->banner" :movie="$movie->title"/>
                    @endif
                @endif

                <x-form.file name="banner" label="Nuevo banner de la película" class="mt-4"/>

                <x-form.number name="year" label="Año de la película" :data="$movie->year" class="mt-4" required/>

                <x-form.number name="runtime" label="Duración de la película" :data="$movie->runtime" class="mt-4" required/>

                <x-form.textarea name="plot" label="Sinopsis de la película" :data="$movie->plot" class="mt-4" required/>

                <x-form.input name="director" label="Director/a de la película" :data="$movie->director" class="mt-4" required/>

                @if(!empty($movie->file))
                    @php
                        $file_path = public_path('storage/' . $movie->file);
                    @endphp

                    @if(file_exists($file_path))
                        <x-form.video name="oldFile" label="Archivo actual de {{ $movie->title }}" :data="$movie->file" />
                    @endif
                @endif

                <x-form.file name="file" label="Archivo de la película" class="mt-4"/>

                @if(!empty($movie->trailer))
                    @php
                        $trailer_path = public_path('storage/' . $movie->trailer);
                    @endphp

                    @if(file_exists($trailer_path))
                        <x-form.video name="oldTrailer" label="Tráiler actual de {{ $movie->title }}" :data="$movie->trailer" />
                    @endif
                @endif

                <x-form.file name="trailer" label="Tráiler de la película" class="mt-4"/>


                <x-form.button class="mt-4 w-64 h-10">Guardar</x-form.button>

                <x-link url="{{ url()->previous() }}">Volver</x-link>
            </form>
        </x-panel>
    <x-panel class="w-50 ml-2 p-2 float-right flex">

        <fieldset>
            <legend>Géneros</legend>
            @foreach($genres as $genre)
                <div class="block m-2 p-2">
                    <x-form.label :name="$genre->name">{{$genre->name}}</x-form>
                    @if($genre->movies->find($movie->id))
                        <form method="POST" action="{{route('peliculas.deleteGenre', $movie->id)}}">
                        @csrf
                        @method('DELETE')
                            <input type="hidden" name="genre_id" value="{{$genre->id}}">
                            <x-form.button class="bg-danger p-4">Eliminar</x-form.button>
                        </form>

                    @else
                        <form method="POST" action="{{route('peliculas.addGenre', $movie->id)}}">
                        @csrf
                            <input type="hidden" name="genre_id" value="{{$genre->id}}">
                            <x-form.button class="bg-success p-4">Añadir</x-form.button>
                        </form>
                    @endif
                </div>
            @endforeach
            </fieldset>
        </x-panel>
    </x-panel>
</x-layout>
