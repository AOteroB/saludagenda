{{-- resources/views/vendor/notifications/email.blade.php --}}
@component('mail::message')
# ¡Hola!

Has recibido este correo porque se solicitó un restablecimiento de contraseña para tu cuenta.

@component('mail::button', ['url' => $actionUrl])
Restablecer contraseña
@endcomponent

Este enlace para restablecer contraseña expirará en 60 minutos.

Si no solicitaste este cambio, no necesitas hacer nada más.

Saludos,<br>
{{ config('app.name') }}
@endcomponent
