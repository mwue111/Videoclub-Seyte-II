<x-layout>
    <x-panel class="mt-4">
        @if(session()->has('user'))
            <div class="flex flex-between">
                @foreach(session('user') as $user)
                    @if($user->image)

                        <x-form.image name="avatar" label="" :data="$user->image" :movie="$user->username"/>

                    @else
                        <x-panel class="h-full">
                        <img src="{{ asset('images/user.png') }}"
                            alt="Imagen de {{ $user->email }}"
                            style="width: 70px; height: 70px; object-fit:cover; margin: 60px auto; border-radius: 100%;"
                            class="mt-4"
                        >
                        </x-panel>
                    @endif

                <ul class="list-group mt-4 ml-4 w-1/2">

                    <h1 class="m-3 text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">¡Bienvenido/a de vuelta, {{ $user->username }}!</h1>

                    <li class="list-group-item flex flex-row justify-between">Nombre: {{ $user->name }}</li>
                    <li class="list-group-item flex flex-row justify-between">Apellido: {{ $user->surname }}</li>
                    <li class="list-group-item flex flex-row justify-between">e-mail: {{ $user->email }}</li>
                    <li class="list-group-item flex flex-row justify-between">Fecha de nacimiento: {{ $user->birth_date }}</li>

                </ul>


                @endforeach
            </div>
        @endif
    </x-panel>
</x-layout>
