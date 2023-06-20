<x-layout>
    <x-panel class="mt-4">
        <table class="table mt-4 text-center">
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
            <tbody>
                @if('users')
                    @foreach($users as $user)
                    <tr>
                        @if($user->image)
                        <td>
                            <img src="{{ asset('storage/' . $user->image) }}"
                                alt="Imagen de {{ $user->email }}"
                                style="width: 70px; height: 70px; object-fit:cover; margin: 0 auto; border-radius: 100%;"
                            >
                        </td>
                        @else
                        <td>
                        <img src="{{ asset('images/user.png') }}"
                            alt="Imagen de {{ $user->email }}"
                            style="width: 70px; height: 70px; object-fit:cover; margin: 0 auto; border-radius: 100%;"
                        >
                        </td>
                        @endif
                        <td>{{ $user->username ? $user->username : 'Sin nombre de usuario' }}</td>
                        <td>{{ $user->name ? $user->name : 'Anónimo' }}</td>
                        <td>{{ $user->surname ? $user->surname : 'Anónimo' }}</td>
                        <td>{{\Carbon\Carbon::parse($user->birth_date)->format('d-m-Y')}}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <form action="{{ route('users.restore', $user->id) }}" method="POST">
                            @csrf
                                <button type="submit" class="btn btn-success show-alert-recover-box">Recuperar</button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('users.force-delete', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button type="submit" class="btn btn-danger show-alert-delete-box">Borrar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </x-panel>
</x-layout>


<script type="text/javascript">

$('.show-alert-recover-box').click(function(event){
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    Swal.fire({
        title: "¿Quieres recuperar este usuario?",
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
                '¡Usuario recuperado!'
            )
        }
    });
});

$('.show-alert-delete-box').click(function(event){
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    Swal.fire({
        title: "¿Seguro/a que quieres eliminar este usuario?",
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
                '¡Usuario borrado!'
            )
        }
    });
});
</script>
