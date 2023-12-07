<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Billete de Reservacion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        .details h4 {
            margin-bottom: 10px;
        }

        .details p {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="content">
        <div class="details">
            <h4>¡Reserva confirmada!</h4>
            <p>Gracias por reservar un asiento en el autobús número: {{ $reservacion->viaje->numero_bus }}</p>
            <h5>Detalles del viaje</h5>
            <p><strong>Fecha y hora:</strong> {{ $reservacion->viaje->fecha_viaje }}
                {{ $reservacion->viaje->hora_viaje }}</p>
            <p><strong>Origen:</strong> {{ $reservacion->viaje->origen }}</p>
            <p><strong>Destino:</strong> {{ $reservacion->viaje->destino }}</p>
            <h5>Detalles de la reserva</h5>
            <p><strong>Nombre:</strong> {{ $reservacion->nombre }}</p>
            <p><strong>DNI:</strong> {{ $reservacion->DNI }}</p>
            <p><strong>Precio:</strong> {{ $reservacion->viaje->precio }} euros</p>
        </div>
    </div>
</body>

</html>
