@extends('app')

@section('contenido')
    <section class="pt-2 mt-4">
        <div class="container">
            @foreach ($viajes as $viaje)
                <div class="row mb-4 justify-content-center">
                    <div class="col-lg-10 colo-md-12 pt-md-2 shadow"
                        style="background-color:rgb(154, 210, 236);border-radius: 5px;">
                        <div class="row pt-2">
                            <div class="col-md-4
                            text-center">
                                <p class="lead" style="font-weight:normal;">{{ $viaje->origen }}</p>
                                <hr style="border-top: 1px solid rgb(185, 33, 33)">
                                <p class="lead mt-3 text-white">{{ date('h:i A', strtotime($viaje->hora_viaje)) }}</p>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center">
                                    <p class="lead " style="font-weight:normal;">Fecha</p>
                                    <hr style="border: 0.5px dashed rgb(0, 0, 0);">
                                    <p class="lead mt-3 text-white">{{ $viaje->fecha_viaje }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="text-center ">
                                    <p class="lead" style="font-weight:normal;">{{ $viaje->destino }}</p>
                                    <hr style="border-top: 1px solid rgb(0, 0, 0); margin: 5px 0;">
                                    <p class="lead mt-3 text-white">{{ date('h:i A', strtotime($viaje->hora_llegada)) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row pt-5 mb-4">
                            <div class="col-md-4 text-center pb-3">
                                <span class="border border-black p-2">Disponible
                                    {{ $viaje->num_asientos > 0 ? $viaje->num_asientos : 0 }} <i
                                        class="fa-solid fa-chair fa-beat-fade fa-lg" style="color: #17514d;"></i> </span>
                            </div>

                            <div class="col-md-4 text-center pb-3"><span class="border border-black p-2">Duracion
                                    {{ $viaje->duracion }} <i class="fa-solid fa-clock"></i>
                                </span></div>

                            <div class="col-md-4">
                                @if ($viaje->num_asientos > 0)
                                    <div class="d-grid justify-content-center justify-content-md-end">
                                        <a href="/resultado/{{ $viaje->id }}/formPersonal"
                                            class="btn btn-danger px-5">{{ $viaje->precio }}
                                            $</a>
                                    </div>
                                @else
                                    <div class="d-grid justify-content-center justify-content-md-end">
                                        <button class="btn btn-outline-secondary px-4" disabled>No Disponible</button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </section>
@endsection
