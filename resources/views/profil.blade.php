@extends('app')

@section('contenido')
    <div class="container mt-5">

        <form action="/resultado/{{ $viaje_id }}/profil/ticket" method="post">
            @csrf
            <div class="row justify-content-center">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show col-lg-8 col-md-12 " role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-lg-8 col-md-12 pt-md-2 shadow p-4"
                    style="background-color:rgb(49, 184, 208);border-radius: 10px;">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <label for="nombre" class="form-label">nombre</label>
                            <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" required>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <label for="DNI" class="form-label">DNI</label>
                            <input type="text" class="form-control" name="DNI" value="{{ old('DNI') }}" required>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="correo_electronico" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="correo_electronico"
                                value="{{ old('correo_electronico') }}" required>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}"
                                placeholder="calle ..." required>
                        </div>
                        <div class="col-md-8 col-sm-12">
                            <label for="ciudad" class="form-label">Ciudad</label>
                            <input type="text" class="form-control" name="ciudad" value="{{ old('ciudad') }}" required>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <label for="codigo_postal" class="form-label">Código Postal</label>
                            <input type="text" class="form-control" name="codigo_postal"
                                value="{{ old('codigo_postal') }}" required>
                        </div>
                        <div class="col-0 mt-4">
                            <button type="submit" class="btn btn-success px-4">reservar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
