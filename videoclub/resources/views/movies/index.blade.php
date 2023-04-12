<table>
  <thead>
    <th>Título</th>
    <th>Año</th>
    <th>Duración</th>
    <th>Sinopsis</th>
    <th>Género</th>
    <th>Director</th>
    <th>Póster</th>
    <th colspan="2">Acciones</th>
  </thead>
  <tbody>
    @forelse($movies as $movie)
    <!-- echo {{$movie->genres}}; -->
    <tr>
      <td>
        <a href="{{ route('peliculas.show', $movie) }}">
          {{ $movie->title }}
        </a>
      </td>
      <td> {{ $movie->year }}</td>
      <td> {{ $movie->runtime }}</td>
      <td> {{ $movie->plot }}</td>
      <td> {{ $movie->genres->pluck('name')->implode(', ')}}</td>
      <td> {{ $movie->director }}</td>
      <td>
        <img src="{{ asset('storage/' . $movie->poster ) }}" alt="Poster de la película {{ $movie->title }}" style="width:10%" />
      </td>
      <td>
        <a href="{{ route('peliculas.edit', $movie) }}">
          Editar
        </a>
      </td>
      <td>
        <form action="{{ route('peliculas.destroy', $movie) }}" method="POST">
          @csrf
          @method('DELETE')
          <input type="submit" value="Eliminar">
        </form>
      </td>
    </tr>
    @empty

    <p>No hay películas aún.</p>

    @endforelse
  </tbody>
</table>


<a href="{{ route('peliculas.create') }}">Añadir película</a>
