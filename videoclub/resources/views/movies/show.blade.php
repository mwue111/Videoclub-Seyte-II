<x-layout>
    <x-panel class="mt-4">
        <h1 class="m-3 text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">{{$movie->title}}</h1>

        <div class="flex flex-between">
        @if(!empty($movie->poster))
            @php
                $poster_path = public_path('storage/' . $movie->poster);
            @endphp
            @if(file_exists($poster_path))
                <x-form.image name="poster" label="" :data="$movie->poster" :movie="$movie->title"/>
            @endif
        @endif

            <ul class="list-group mt-4 ml-4">
            <li class="list-group-item flex flex-row justify-between">Año de salida: {{ $movie->year }}</li>
            <li class="list-group-item flex flex-row justify-between">Duración: {{ $movie->runtime }} minutos.</li>
            <li class="list-group-item flex flex-row justify-between">Género/s: {{ $movie->genres->pluck('name')->implode(', ') }}</li>
            <li class="list-group-item flex flex-row justify-between">Director: {{ $movie->director }}</li>
            <li class="list-group-item flex flex-row justify-between">Sinopsis: {{ $movie->plot }}</li>
        </ul>

        </div>
        <div class="flex flex-column flex-between">
            @if(!empty($movie->file) || !empty($movie->trailer))
                @php
                    $file_path = public_path('storage/' . $movie->file);
                    $trailer_path = public_path('storage/' . $movie->trailer);
                @endphp

                @if(file_exists($trailer_path))
                    <x-form.video name="oldFile" label="Tráiler actual de {{ $movie->title }}" :data="$movie->trailer" />
                @endif

                @if(file_exists($file_path))
                    <x-form.video name="oldTrailer" label="Archivo actual de {{ $movie->title }}" :data="$movie->file" />
                @endif

            @endif
        </div>

        <x-link url="{{ url()->previous() }}">Volver</x-link>

    </x-panel>
</x-layout>
