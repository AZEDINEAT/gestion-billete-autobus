<nav class="navbar navbar-expand-lg navbar-light" style="background-color:  #52d4eb;">
    <div class="container-fluid">
        <a class="navbar-brand" href="/"> <img src="{{ asset('imagens/bus-ticket.png') }}"
                style="max-width: 40px; height: auto;" alt="logo autobus" class="bus-image "> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Inicio</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="/crearViaje">Crear Viaje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mostrarViajes">Mostrar Viajes</a>
                    </li>
                @endauth
            </ul>
            @auth
                <ul class="navbar-nav">
                    <div class="dropdown">
                        <button class="btn text-white dropdown-toggle "
                            style="background-color: 
                        rgb(0, 0, 0)" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->nombre }}

                        </button>
                        <ul class="dropdown-menu text-center  dropdown-menu-dark">
                            <li>{{ Auth::user()->correo }}</li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Cerrar sesión</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Iniciar sesión</a>
                        </li>
                    @endauth
                </ul>
                @if ($_SERVER['REQUEST_URI'] == '/')
                    <div class="d-flex ms-lg-auto ms-md-0" style="max-width: 500px">
                        <input class="form-control" type="text" id="dni" name="dni" placeholder="DNI">
                        <button class="btn btn-danger mx-2 text-white" id="buscarBtn">Buscar</button>
                    </div>
                @endif
        </div>
    </div>
</nav>
