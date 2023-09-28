@extends('app')

@section('contenido')
    <div class="row justify-content-center pt-5">
        <div class="col-md-5">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                </div>
            @endif
            <div class="card shadow" style="background-color: rgb(163, 243, 236)">
                <div class="card-header" style="background-color:rgb(49, 184, 208)">
                    <h4 class="card-title">Iniciar Sesión</h4>
                </div>
                <div class="card-body">
                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control mt-2" id="email" name="email" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control mt-2" id="password" name="password" required>
                        </div>
                        <div class="form-group row mt-3">
                            <div class="col-md-4 row offset-md-4">
                                <button type="submit" class="btn btn-block"
                                    style="color:white ;background-color: rgb(55, 126, 201)">
                                    Iniciar Sesión
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
