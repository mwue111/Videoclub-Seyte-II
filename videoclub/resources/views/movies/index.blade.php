<table>
    <thead>
        <th>Título</th>
        <th>Año</th>
        <th>Duración</th>
        <th>Sinopsis</th>
        <th>Género</th>
        <th>Director</th>
        <th colspan="2">Acciones</th>
    </thead>
    <tbody>
        @forelse($movies as $movie)
        <tr>
            <td>
                <a href="{{ route('peliculas.show', $movie) }}" target="_blank">
                    {{ $movie->title }}
                </a>
            </td>
            <td> {{ $movie->year }}</td>
            <td> {{ $movie->runtime }}</td>
            <td> {{ $movie->plot }}</td>
            <td> {{ $movie->genre }}</td>
            <td> {{ $movie->director }}</td>
            <td> <img src="{{ $movie->poster }}" alt="Poster de la película {{ $movie->title }}" style="width:10%"/></td>
            <td> Editar </td>
            <td> Eliminar </td>
        </tr>
        @empty

            <p>No hay películas aún.</p>

        @endforelse
    </tbody>
</table>


<a href="{{ route('peliculas.create') }}">Añadir película</a>
