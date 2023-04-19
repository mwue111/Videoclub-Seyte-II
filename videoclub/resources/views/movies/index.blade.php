<x-layout>
    <div style="padding: 20px;">
        <form action="{{ route('peliculas.create') }}" method="GET">
        @csrf
            <input type="submit" value="Añadir película" class="btn btn-primary">
        </form>
    </div>

    <table class="table">
      <thead class="table-light">
        <th>Título</th>
        <th>Año</th>
        <th>Duración</th>
        <th>Sinopsis</th>
        <th>Género</th>
        <th>Director</th>
        <th>Póster</th>
        <th>Banner</th>
        <th colspan="2">Acciones</th>
      </thead>
      <tbody>
        @if($movies->count())
        @forelse($movies as $movie)
        <tr>
          <td>
            <a href="{{ route('peliculas.show', $movie) }}" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
              {{ $movie->title }}
            </a>
          </td>
          <td> {{ $movie->year }}</td>
          <td> {{ $movie->runtime }}</td>
          <td> {{ $movie->plot }}</td>
          <td> {{ $movie->genres->pluck('name')->implode(', ')}}</td>
          <td> {{ $movie->director }}</td>
          <td>
            <img src="{{ asset('storage/' . $movie->poster ) }}" alt="Poster de la película {{ $movie->title }}" class="img-thumbnail" />
          </td>
          <td>
            <img src="{{ asset('storage/' . $movie->banner ) }}" alt="Banner de la película {{ $movie->title }}" class="img-thumbnail"/>
          </td>
          <td>
            <form action="{{ route('peliculas.edit', $movie) }}" method="GET">
            @csrf
                <input type="submit" value="Editar" class="btn btn-warning">
            </form>
          </td>
          <td>
              <!-- <a href="#" onclick="confirmErase('{{ route('peliculas.destroy', $movie->id) }}')">Eliminar</a> -->
              <!-- <td><a href="#" onclick="confirmErase(' . $resource['id'] . ', \'' . $route . '\')">Eliminar</a></td> -->
            <form action="{{ route('peliculas.destroy', $movie->id) }}" method="POST">
            @csrf
            @method('DELETE')
                <input type="submit" value="Eliminar" onclick="return confirm('¿Seguro que quieres eliminar esta película?')" class="btn btn-danger">
            </form>
          </td>
        </tr>
        @empty

        <p>No hay películas aún.</p>

        @endforelse
        @endif
        </tbody>
    </table>
    {{ $movies->links() }}
</x-layout>


