<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error 404 - Página no encontrada</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #82d5ff;
        }

        .error-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .error-heading {
            font-size: 8em;
            margin-bottom: 0.2em;
            color: #dc3545;
            animation: heartbeat 1.5s ease-in-out infinite;
        }

        .error-text {
            font-size: 2em;
            margin-bottom: 1.5em;
        }

        @keyframes heartbeat {
            0% {
                transform: scale(1);
            }

            20% {
                transform: scale(1.3);
            }

            40% {
                transform: scale(1);
            }

            60% {
                transform: scale(1.3);
            }

            80% {
                transform: scale(1);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-container">
            <div class="text-center">
                <h1 class="error-heading">404</h1>
                <p class="error-text">Página no encontrada</p>
                <a href="/" class="btn btn-primary">Ir a la página de inicio</a>
            </div>
        </div>
    </div>
</body>

</html>
