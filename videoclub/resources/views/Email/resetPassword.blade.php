@component('mail::message')
# Recupera tu contraseña
Este es el correo para recuperar tu contraseña.

@component('mail::button', ['url' => 'http://localhost:4200/auth/cambiar-contrasena?token='.$token])
Cambiar contraseña

@endcomponent
Gracias,<br>
{{ config('app.name') }}

@endcomponent
