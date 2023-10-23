@extends('app')

@section('contenido')
    <section class="pt-0  pt-lg-5">
        <div class="container ">
            @foreach ($viajes as $viaje)
                <div class="row mb-3 ">
                    <div class="col-8 p-2 shadow"
                        style="background-color:rgb(49, 184, 208);margin-left:120px ;border-radius: 5px;">
                        <div style="margin-left: 10px ; float:left" class="text-center">
                            <p class="lead" style="font-weight:normal;">{{ $viaje->origen }}</p>
                            <hr style="border-top: 1px solid rgb(0, 0, 0); margin: 5px 0;">
                            <p class="lead mt-3 text-white">{{ date('h:i A', strtotime($viaje->hora_viaje)) }}</p>
                        </div>
                        <div style="margin-left:230px ;float: left;" class="text-center">
                            <p class="lead " style="font-weight:normal;">fecha</p>
                            <hr style="border-top: 1px solid rgb(0, 0, 0); margin: 5px 0;">
                            <p class="lead mt-3 text-white">{{ $viaje->fecha_viaje}}</p>
                        </div>

                        <div style="margin-right:10px;float: right;" class="text-center">
                            <p class="lead" style="font-weight:normal;">{{ $viaje->destino }}</p>
                            <hr style="border-top: 1px solid rgb(0, 0, 0); margin: 5px 0;">
                            <p class="lead mt-3 text-white">{{ date('h:i A', strtotime($viaje->hora_llegada)) }}</p>
                        </div>
                        <div style="margin-top:15%;margin-left:5px;">
                            <p class="lead" style="font-weight:100;color:rgb(0, 0, 0)">disponible:{{ $viaje->num_asientos}}</p>
                        </div>
                        <div style="margin-left:5px;">
                            <p class="lead" style="font-weight:100;color:rgb(0, 0, 0)">duracion:{{ $viaje->duracion}} S</p>
                        </div>
                        
                        

                        @if ($viaje->num_asientos > 0)
                            <div style="float:right">
                                <a href="/resultado/{{ $viaje->id }}/profil"
                                    class="btn btn-danger px-5">{{ $viaje->precio }} $</a>
                            </div>
                        @else
                            <div style="float:right;">
                                <button class="btn btn-outline-secondary px-4" disabled>No disponible</button>
                            </div>
                        @endif
                    </div>

                </div> <!-- Row END -->
            @endforeach
        </div>

    </section>
@endsection
