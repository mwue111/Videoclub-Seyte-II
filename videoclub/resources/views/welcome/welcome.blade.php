<x-layout>
    <x-panel class="mt-4">
        @if(session()->has('user'))
            <div class="flex flex-between">
                @foreach(session('user') as $user)
                    @if($user->image)
                    <div class="w-1/2">
                        <x-form.image name="avatar" label="" :data="$user->image" :movie="$user->username"></x-form>
                    </div>

                    @else
                    <div>
                        <p>No tienes avatar aún.</p>
                    </div>
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
