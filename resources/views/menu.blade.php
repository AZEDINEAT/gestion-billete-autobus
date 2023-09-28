<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: rgb(58, 172, 190)">
    <a class="navbar-brand " style="margin-left: 5px" href="/">azdibus</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="/">Inicio</a>
            </li>
            @auth
            <li class="nav-item">
                <a class="nav-link" href="/crearViaje">crear viaje</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/mostrarViajes">mostrar viajes</a>
            </li>
            @endauth
        </ul>
        @auth
        <ul class="navbar-nav"  style="margin-left:20px" >
                <div class="dropdown">
                    <button class="btn text-white dropdown-toggle " style="background-color: rgb(78, 14, 10)" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->nombre }}
                        
                    </button>
                    <ul class="dropdown-menu text-center  dropdown-menu-dark" >
                        <li>{{ Auth::user()->email }}</li>
                        <li><hr class="dropdown-divider"></li>
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
    </div>
    @if($_SERVER['REQUEST_URI'] == '/')
    <div class="d-flex ms-auto mx-3">
        <input class="form-control me-2" type="text" id="dni" name="dni" placeholder="DNI" >
        <button class="btn btn-outline-danger text-white" id="buscarBtn" >Buscar</button>
    </div>  
    @endif
    
</nav>
