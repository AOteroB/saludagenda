@component('mail::message')
# Confirmación de Cita

Hola {{ $event->user->name }},

Tu cita ha sido reservada con éxito. Aquí están los detalles:

- **Especialidad:** {{ $event->specialty->name }}
- **Doctor:** {{ $event->doctor->name }} {{ $event->doctor->last_name }}
- **Fecha y hora:** {{ \Carbon\Carbon::parse($event->start)->format('d/m/Y H:i') }}
- **Ubicación:** {{ $event->specialty->location ?? 'Centro Médico Principal' }}

Gracias por confiar en nosotros.

@component('mail::button', ['url' => url('/admin/events/show')])
Ver mis citas
@endcomponent

Saludos cordiales,  
{{ config('app.name') }}
@endcomponent
