<x-layout>
    @if('users')
    <table class="table mt-4">
        <thead class="table-light text-center">
            <th>Avatar</th>
            <th>Nombre de usuario</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Fecha de nacimiento</th>
            <th>e-mail</th>
            <th>Rol</th>
            <th colspan="2">Acciones</th>
        </thead>
        <tbody class="text-center">
        @foreach($users as $user)
            <tr>
                <td>
                    @if($user->image)
                    <img src="{{ asset('storage/' . $user->image) }}"
                        alt="Imagen de {{ $user->email }}"
                        style="width: 70px; height: 70px; object-fit:cover; margin: 0 auto; border-radius: 100%;"
                    >
                    @else
                    <img src="{{ asset('images/user.png') }}"
                        alt="Imagen de {{ $user->email }}"
                        style="width: 70px; height: 70px; object-fit:cover; margin: 0 auto; border-radius: 100%;"
                    >
                    @endif
                </td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->surname }}</td>
                <td>{{\Carbon\Carbon::parse($user->birth_date)->format('d-m-Y')}}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <form action="{{ route('usuarios.edit', $user->id) }}" method="GET">
                    @csrf
                        <input type="submit" value="Editar" class="btn btn-warning">
                    </form>
                </td>
                <td>
                    <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                        <button type="submit" class="btn btn-danger show-alert-delete-box" data-toggle="tooltip" title='Delete'>Borrar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    @endif
</x-layout>

<script type="text/javascript">
$('.show-alert-delete-box').click(function(event){
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    Swal.fire({
        title: "¿Seguro/a que quieres eliminar este usuario?",
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
                '¡Usuario borrado!'
            )
        }
    });
});

</script>
