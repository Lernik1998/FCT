<!-- <head>
    <title>Reservation Payment</title>
</head>

<x-mail::message>

    <x-mail::panel>

        <h1>Hola, {{ $name }}</h1>
    </x-mail::panel>

    <p>Tu pago de reserva ha sido recibido correctamente.</p>

</x-mail::message> -->


@component('mail::message')
# {{ __('Reserva confirmada para la actividad: :activity', ['activity' => $activity->name]) }}

{{ __('Hola :name, tu reserva ha sido registrada correctamente.', ['name' => $user->name]) }}

**Detalles de la actividad:**
- {{ __('Nombre: :name', ['name' => $activity->name]) }}
- {{ __('Fecha: :date', ['date' => $activity->date->format('d/m/Y')]) }}
- {{ __('Hora: :time', ['time' => $activity->time]) }}
- {{ __('Lugar: :place', ['place' => $activity->place]) }}

**Detalles de la reserva:**
- {{ __('Número de personas: :count', ['count' => $reservation->people_count]) }}
- {{ __('Precio total: :price €', ['price' => number_format($reservation->total_price, 2)]) }}

@if(!$reservation->is_paid)
    {{ __('Para completar tu reserva, realiza el pago haciendo clic en el siguiente botón:') }}

    @component('mail::button', ['url' => $paymentUrl])
    {{ __('Pagar ahora') }}
    @endcomponent
@else
    {{ __('Tu pago ha sido recibido. ¡Gracias por confiar en nosotros!') }}
@endif

{{ __('Si tienes alguna duda, responde a este correo o contacta con nuestro equipo de soporte.') }}
@endcomponent