@extends('app')

@section('contenido')
    <section class="py-5">
        <div class="container ">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card" style="background-color: rgb(163, 243, 236)">
                    
                        @if (isset($viaje))
                        <div class="card-header" style="background-color: rgb(49, 184, 208) ;">Modificar viaje</div>
                        <div class="card-body ">
                            <form action="/modificar/{{$viaje->id}}" method="POST">
                                @method('PUT')
                            @else
                            <div class="card-header " style="background-color: rgb(49, 184, 208)">Crear viaje</div>
                            <div class="card-body ">
                            <form method="POST" action="{{ route('crearViaje') }}">
                        @endif
                                @csrf
                                <div class="form-group row mb-2">
                                    <label for="numero_bus" class="col-md-4 col-form-label text-md-right">Número de
                                        autobús</label>

                                    <div class="col-md-6">
                                        <input id="numero_bus" type="number" class="form-control" name="numero_bus"
                                            value="{{ isset($viaje) ? $viaje->numero_bus : old('numero_bus') }}" required autocomplete="off" autofocus>
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="fecha_viaje" class="col-md-4 col-form-label text-md-right">Fecha del
                                        viaje</label>

                                    <div class="col-md-6">
                                        <input id="fecha_viaje" type="date" class="form-control" name="fecha_viaje"
                                            value="{{ isset($viaje) ? $viaje->fecha_viaje : old('fecha_viaje') }}" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="hora_viaje" class="col-md-4 col-form-label text-md-right">Hora del
                                        viaje</label>

                                    <div class="col-md-6">
                                        <input id="hora_viaje" type="time" class="form-control" name="hora_viaje"
                                            value="{{ isset($viaje) ? $viaje->hora_viaje : old('hora_viaje') }}" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="hora_llegada" class="col-md-4 col-form-label text-md-right">Hora del
                                        llegada</label>

                                    <div class="col-md-6">
                                        <input id="hora_llegada" type="time" class="form-control" name="hora_llegada"
                                            value="{{ isset($viaje) ? $viaje->hora_llegada : old('hora_llegada') }}" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="origen" class="col-md-4 col-form-label text-md-right">Origen</label>

                                    <div class="col-md-6">
                                        <input id="origen" type="text" class="form-control" name="origen"
                                            value="{{ isset($viaje) ? $viaje->origen : old('origen') }}" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="destino" class="col-md-4 col-form-label text-md-right">Destino</label>

                                    <div class="col-md-6">
                                        <input id="destino" type="text" class="form-control" name="destino"
                                            value="{{ isset($viaje) ? $viaje->destino : old('destino') }}" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row mb-2">
                                    <label for="num_asientos_dispo" class="col-md-4 col-form-label text-md-right">
                                        asientos disponibles</label>

                                    <div class="col-md-6">
                                        <input id="num_asientos_dispo" type="number" class="form-control"
                                            name="num_asientos_dispo" value="{{ isset($viaje) ? $viaje->num_asientos : old('num_asientos_dispo') }}" required
                                            autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-group row mb-3">
                                    <label for="precio" class="col-md-4 col-form-label text-md-right">Precio</label>

                                    <div class="col-md-6">
                                        <input id="precio" type="number" step="0.01" class="form-control"
                                            name="precio" value="{{ isset($viaje) ? $viaje->precio : old('precio') }}" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <div class="col-md-2 row offset-md-10">
                                        <button type="submit" class="btn btn-success btn-block">
                                        @if(isset($viaje))
                                            Modificar
                                          @else
                                            Crear
                                          @endif
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
