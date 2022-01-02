@component('mail::message')
# Nueva sugerencia de la App

Nombre: {{ $mailData['nombre'] }}<br>
Teléfono: {{ $mailData['telefono'] }}<br>
Correo: {{ $mailData['correo'] }}<br>


{{ $mailData['sugerencia'] }}


{{ config('app.name') }}
@endcomponent
