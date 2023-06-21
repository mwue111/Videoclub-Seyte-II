<x-layout>
    <x-panel class="mt-2 mb-4 w-1/2 m-auto">
        <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">Añadir película</h1>

        <form action="{{ route('peliculas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <x-form.input name="title" label="Título de la película" required/>

            <x-form.file name="poster" label="Póster de la película" class="mt-4"/>

            <x-form.file name="banner" label="Banner de la película" class="mt-4"/>

            <x-form.number name="year" label="Año de la película" required class="mt-4"/>

            <x-form.number name="runtime" label="Duración de la película" required class="mt-4"/>

            <x-form.textarea name="plot" label="Sinopsis de la película" required class="mt-4"/>

            <x-form.multiselect name="genre_id[]" label="Género/s de la película" :data="$genres" class="mt-4"/>

            <x-form.input name="director" label="Director/a de la película" required class="mt-4"/>

            <x-form.file name="file" label="Archivo de la película" class="mt-4"/>

            <x-form.file name="trailer" label="Tráiler de la película" class="mt-4"/>

            <x-form.number name="price" label="Precio de alquiler de la película" required class="mt-4"/>

            <x-form.button class="mt-4 w-64 h-10">Añadir</x-form.button>

            <x-link url="{{ route('peliculas.index') }}">Volver</x-link>
        </form>
    </x-panel>

</x-layout>
