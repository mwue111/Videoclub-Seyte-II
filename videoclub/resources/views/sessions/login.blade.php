<x-layout>

    <x-panel class="mt-4 mb-4 w-1/2 m-auto">
        <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">Iniciar sesión</h1>

        <form action="/login"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf

            <x-form.email name="email" label="Correo electrónico" required/>

            <x-form.pass name="password" label="Contraseña"/>

            <input type="hidden" name="remember_me" value="true"/>

            <x-form.button class="mt-4">Acceder</x-form>

        </form>
    </x-panel>
</x-layout>
