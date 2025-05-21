@component('mail::message')
# Cita Cancelada

Hola {{ $event->user->name }},

Lamentamos informarte que tu cita ha sido cancelada. Aquí tienes los detalles:

- **Especialidad:** {{ $event->specialty->name }}
- **Doctor:** {{ $event->doctor->name }} {{ $event->doctor->last_name }}
- **Fecha y hora:** {{ \Carbon\Carbon::parse($event->start)->format('d/m/Y H:i') }}

Si deseas agendar una nueva cita, por favor visita tu panel de usuario.

@component('mail::button', ['url' => url('/admin')])
Reservar otra cita
@endcomponent

Saludos cordiales,  
{{ config('app.name') }}
@endcomponent
