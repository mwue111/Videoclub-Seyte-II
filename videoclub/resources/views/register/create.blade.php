<x-layout>
    <x-panel class="mt-4 mb-4 w-1/2 m-auto">
        <h1 class="text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-2xl lg:text-3xl dark:text-white">Registrarse</h1>
        <form method="POST" action="/register">
            @csrf
            <x-form.input name="email" label="Correo electrónico" required />

            <x-form.date name="birth_date" label="Fecha de nacimiento" required/>

            <x-form.pass name="password" label="Contraseña" required/>

            <x-form.pass name="c_password" label="Confirmación de contraseña" required/>

            <x-form.button class="mt-4">Registrarse</x-form.button>
        </form>
    </x-panel>
</x-layout>
