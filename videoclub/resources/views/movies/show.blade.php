<x-layout>
    <x-panel class="mt-4">
        <h1 class="m-3 text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">{{$movie->title}}</h1>

        <div class="flex flex-between">
            <x-form.image name="poster" label="" :data="$movie->poster" :movie="$movie->title"/>

            <ul class="list-group mt-4 ml-4">
            <li class="list-group-item flex flex-row justify-between">Año de salida: {{ $movie->year }}</li>
            <li class="list-group-item flex flex-row justify-between">Duración: {{ $movie->runtime }} minutos.</li>
            <li class="list-group-item flex flex-row justify-between">Género/s: {{ $movie->genres->pluck('name')->implode(', ') }}</li>
            <li class="list-group-item flex flex-row justify-between">Director: {{ $movie->director }}</li>
            <li class="list-group-item flex flex-row justify-between">Sinopsis: {{ $movie->plot }}</li>
        </ul>
        </div>

        <x-link url="{{ route('peliculas.index') }}">Volver</x-link>

    </x-panel>
</x-layout>
