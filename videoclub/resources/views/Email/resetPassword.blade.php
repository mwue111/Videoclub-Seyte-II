@component('mail::message')
# Reset Password
Reset or change your password.

@component('mail::button', ['url' => 'http://localhost:4200/change-password?token='.$token])
Change Password

@endcomponent
Thanks,<br>
{{ config('app.name') }}

@endcomponent

<!-- <x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> -->
