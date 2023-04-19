<x-layout>
    @forelse($genres as $genre)
    <ul>
        <li>
            <a href="{{ route('generos.show', $genre->id) }}">{{$genre -> name}}</a> -
            <a href="{{ route('generos.edit', $genre->id) }}">Editar</a> -
            <form action="{{route('generos.destroy', $genre->id) }}" method="POST">
            @csrf
            @method('DELETE')
                <input type="submit" value="Eliminar" onclick="return confirm('¿Seguro que quieres eliminar este género?')">
            </form>
        </li>
    </ul>

    @empty
    <p>No hay géneros disponibles</p>
    @endforelse
    <a href="{{ route('generos.create') }}">Añadir nuevo género</a>
    <br>
    <a href="{{ route('peliculas.index') }}">Volver</a>
</x-layout>
