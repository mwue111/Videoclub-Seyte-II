<x-layout>
    <x-panel class="mt-4 flex flex-column w-1/2 m-auto">
        <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white m-auto">Añadir género</h1>

        <form action="{{ route('generos.store') }}" method="POST">
        @csrf

            <x-form.input name="name" label="Nombre del género" required />

            <div class="flex justify-between">
                <x-form.button class="mt-4 w-64 h-10">Añadir</x-form.button>

                <x-link url="{{ route('generos.index') }}">Volver</x-link>
            </div>

        </form>

    </x-panel>
</x-layout>
