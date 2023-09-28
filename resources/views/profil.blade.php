@extends('app')

@section('contenido')
    <div class="container p-5">
        <form action="/resultado/{{ $viaje_id }}/profil/ticket" method="post">
            @csrf
            <div class="row shadow justify-content-center p-4"
                style="margin-left:15%;background-color:rgb(49, 184, 208);border-radius: 5px;width:70%">
                @if ($errors->any())
                    <div class="alert alert-dismissible fade show" style="background-color: rgb(156, 139, 13)" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-4">
                    <label for="nombre" class="form-label">nombre</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" >
                </div>
                <div class="col-8">
                    <label for="DNI" class="form-label">DNI</label>
                    <input type="text" class="form-control" name="DNI" value="{{ old('DNI') }}"  >
                </div>
                <div class="col-12">
                    <label for="correo_electronico" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" name="correo_electronico" value="{{ old('correo_electronico') }}" >
                </div>
                <div class="col-12">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" placeholder="calle ..." >
                </div>
                <div class="col-8">
                    <label for="ciudad" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" name="ciudad" value="{{ old('ciudad') }}" >
                </div>
                <div class="col-4">
                    <label for="codigo_postal" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" name="codigo_postal" value="{{ old('codigo_postal') }}" >
                </div>
                <div class="col-0 mt-4">
                    <button type="submit" class="btn btn-success px-4">reservar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
