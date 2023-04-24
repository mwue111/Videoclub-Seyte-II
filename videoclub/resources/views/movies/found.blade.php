<x-layout>
    <form action="{{ route('peliculas.create') }}" method="GET">
    @csrf
        <x-form.button class="my-3 px-8">Añadir película</x-form>
    </form>

    @if(isset($movies) && $movies !== null)
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

            @foreach($movies as $movie)
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
                        <form action="{{ route('peliculas.destroy', $movie->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                            <button type="submit" class="btn btn-danger show-alert-delete-box" data-toggle="tooltip" title='Delete'>Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
        @else
        <div class="bg bg-danger my-4 p-2 text-center text-white w-1/2 m-auto rounded-xl">
            <p>Ninguna película coincide con el criterio de búsqueda.</p>
        </div>
        @endif
      </tbody>
    </table>
    @if($movies !== null)
        {{ $movies->appends(Request::except('page'))->links() }}
    @endif
    <div class="float-right">
        <x-link url="{{ url()->previous() }}">Volver</x-link>
    </div>
</x-layout>

<script type="text/javascript">
$('.show-alert-delete-box').click(function(event){
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    Swal.fire({
        title: "¿Seguro/a que quieres eliminar esta película?",
        icon: "warning",
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((willDelete) => {
        if (willDelete.isConfirmed) {
            form.submit();
            Swal.fire(
                '¡Película borrada!'
            )
        }
    });
});

</script>
