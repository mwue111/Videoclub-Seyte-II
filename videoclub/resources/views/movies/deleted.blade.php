<x-layout>

    <table class="table mt-4">
        <thead class="table-light text-center">
            <th>Título</th>
            <th>Fecha eliminación</th>
            <th colspan="2">Acciones</th>
        </thead>
        <tbody>
            @if($movies)
                @foreach($movies as $movie)
                    <tr>
                        <td class="text-center">
                            {{ $movie->title }}
                        </td>
                        <td class="text-center">
                            {{ $movie->deleted_at->format('d-m-Y') }}
                        </td>
                        <td class="text-right">
                            <form action="{{ route('movies.restore', $movie->id) }}" method="POST">
                            @csrf
                                <button type="submit" class="btn btn-success show-alert-recover-box">Recuperar</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('movies.force-delete', $movie->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger show-alert-delete-box">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </ul>
            @endif
        </tbody>
    </table>
    <div class="float-right">
        <x-link url="{{ url()->previous() }}">Volver</x-link>
    </div>
</x-layout>

<script type="text/javascript">

$('.show-alert-recover-box').click(function(event){
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    Swal.fire({
        title: "¿Quieres recuperar esta película?",
        icon: "warning",
        showCloseButton: true,
        showCancelButton: true,
        focusConfirm: false,
        confirmButtonText: 'Recuperar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
    }).then((willRecover) => {
        if (willRecover.isConfirmed) {
            form.submit();
            Swal.fire(
                '¡Película recuperada!'
            )
        }
    });
});

$('.show-alert-delete-box').click(function(event){
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    Swal.fire({
        title: "¿Seguro/a que quieres eliminar esta película?",
        text: "Esta acción no podrá deshacerse.",
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
