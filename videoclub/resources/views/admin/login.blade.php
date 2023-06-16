<x-layout>

    <x-panel class="mt-2 mb-4 w-1/2 m-auto">
        <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">Iniciar sesión</h1>
        <form action="{{ route('admin.login') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            <x-form.input name="email" label="Correo electrónico" required />

            <x-form.pass name="password" label="Contraseña"/>

            <x-form.button class="mt-4">Acceder</x-form>

        </form>
    </x-panel>
</x-layout>
