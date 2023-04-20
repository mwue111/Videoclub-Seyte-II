<x-layout>
    <x-panel class="mt-4 flex flex-column w-1/2 m-auto">
    <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white m-auto">Géneros</h1>

        @forelse($genres as $genre)
        <ul class="list-group mt-4">
            <li class="list-group-item flex flex-row justify-between">
                <x-form.label name="{{ $genre->name }}" class="mt-2 flex-none">{{ $genre->name }}</x-form>

                <div class="flex flex-end">
                    <form action="{{ route('generos.edit', $genre->id) }}" method="GET" class="mx-2">
                    @csrf
                        <input type="submit" value="Editar" class="btn btn-warning">
                    </form>

                    <form action="{{route('generos.destroy', $genre->id) }}" method="POST" class="mx-2">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="Eliminar" onclick="return confirm('¿Seguro que quieres eliminar este género?')" class="btn btn-danger">
                    </form>
                </div>
            </li>
        </ul>

        @empty
        <p>No hay géneros disponibles</p>
        @endforelse
        <div class="flex justify-between">
            <form action="{{ route('generos.create') }}">
            @csrf
                <x-form.button class="my-3 px-8">Añadir nuevo género</x-form>
            </form>
            <x-link url="{{ route('peliculas.index') }}" class="mt-4">Ir a películas</x-link>
        </div>

        {{ $genres->links() }}
    </x-panel>
</x-layout>
