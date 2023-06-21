<x-layout>
    <h1 class="m-3 text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">Editar {{$user->email}}</h1>
    <x-panel>
        <form action="{{ route('usuarios.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
            <x-form.input name="username" label="Nombre de usuario" :data="$user->username"/>

            @if($user->image)
                @php
                    $avatar_path = public_path('storage/' . $user->image);
                @endphp

                @if(file_exists($avatar_path))
                <x-form.image name="oldAvatar" class="mt-3" label="Avatar actual" :data="$user->image" :movie="$user->email" />
                @endif
            @endif

            <x-form.file name="image" label="Nuevo avatar" class="mt-4" />

            <x-form.input name="name" label="Nombre" :data="$user->name"/>

            <x-form.input name="surname" label="Apellido" :data="$user->surname"/>

            <x-form.email name="email" label="e-mail" :data="$user->email"/>

            <x-form.date name="birth_date" label="Fecha de nacimiento" :data="$user->birth_date" />

            <x-form.button class="mt-4 w-65 h-10">Guardar</x-form.button>

            <x-link url="{{ url()->previous() }}">Volver</x-link>
        </form>
    </x-panel>
</x-layout>
