@extends('app')

@section('contenido')
    <section class="pt-0 pt-lg-1 mt-5 mb-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header text-white" style="background-color:  rgb(49, 184, 208)">Confirmación de
                            reserva</div>

                        <div class="card-body" style="background-color:rgb(163, 243, 236) ">
                            <h4>¡Reserva confirmada!</h4>
                            <p>Gracias por reservar un asiento en el autobus numero "{{ $reservacion->viaje->numero_bus }}"
                            </p>

                            <div class="row">
                                <div class="col-sm-6">
                                    <h5>Detalles del viaje</h5>
                                    <p><strong>Fecha y hora:</strong> {{ $reservacion->viaje->fecha_viaje }}
                                        {{ $reservacion->viaje->hora_viaje }} </p>
                                    <p><strong>Origen:</strong> {{ $reservacion->viaje->origen }}</p>
                                    <p><strong>Destino:</strong> {{ $reservacion->viaje->destino }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <h5>Detalles de la reserva</h5>
                                    <p><strong>nombre:</strong> {{ $reservacion->nombre }}</p>
                                    <p><strong>DNI:</strong> {{ $reservacion->DNI }}</p>
                                    <p><strong>Precio:</strong> {{ $reservacion->viaje->precio }} euros</p>
                                </div>
                            </div>
                            <a href="/" class="btn btn-primary mb-2">Volver al inicio</a>
                            <a href="{{ route('descargar_pdf', $reservacion->id) }}" class="btn btn-primary mb-2 ">Descargar
                                en
                                PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
