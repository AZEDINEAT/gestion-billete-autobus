<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>

    @include('menu')
    <div class="container">
        @yield('contenido')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <style>
        .progress-bar {
            height: 20px;
            background-color: #f8f9fa;
            /* Color de fondo de los puntos */
            overflow: hidden;
        }

        @keyframes move {
            0% {
                margin-left: -100%;
            }

            100% {
                margin-left: 100%;
            }
        }

        .progress-bar::before {
            content: '';
            display: block;
            width: 10px;
            /* Tamaño de cada punto */
            height: 10px;
            /* Tamaño de cada punto */
            background-color: #007bff;
            /* Color de los puntos */
            border-radius: 50%;
            /* Hace que los puntos sean redondos */
            animation: move 2s infinite;
            /* Duración y repetición de la animación */
        }
    </style>
</body>

</html>
