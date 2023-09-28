<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h4>¡Reserva confirmada!</h4>
    <p>Gracias por reservar un asiento en el autobus numero "{{ $reservacion->viaje->numero_bus }}"
    <h5>Detalles del viaje</h5>
    <p><strong>Fecha y hora:</strong> {{ $reservacion->viaje->fecha_viaje }}
        {{ $reservacion->viaje->hora_viaje }} </p>
    <p><strong>Origen:</strong> {{ $reservacion->viaje->origen }}</p>
    <p><strong>Destino:</strong> {{ $reservacion->viaje->destino }}</p>


    <h5>Detalles de la reserva</h5>
    <p><strong>nombre:</strong> {{ $reservacion->nombre }}</p>
    <p><strong>DNI:</strong> {{ $reservacion->DNI }}</p>
    <p><strong>Precio:</strong> {{ $reservacion->viaje->precio }} euros</p>


<p>Se ha enviado un correo electrónico de confirmación a la dirección
    "{{ $reservacion->correo_electronico }}"con los detalles de la reserva.</p>

</body>
</html>
   


