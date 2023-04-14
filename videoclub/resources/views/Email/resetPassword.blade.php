<x-mail::message>
  # Introduction
  Este correo es para restablecer tu contraseña
  The body of your message.

  <x-mail::button :url="'http://localhost:4200/auth/recuperar?token='.{{token}}">
    Button Text
  </x-mail::button>

  Thanks,<br>
  {{ config('app.name') }}
</x-mail::message>