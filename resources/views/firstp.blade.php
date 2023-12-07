@extends('app')

@section('contenido')
    <section class="mt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-sm-12 col-lg-6 ">
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card shadow" style="background-color: rgb(163, 243, 236) ;">

                        <!-- Card header -->
                        <div class="card-header border-bottom p-3 p-sm-4" style="background-color:rgb(49, 184, 208) ;">
                            <h5 class="card-title text-center text-white">Buscar Tu Viaje</h5>
                        </div>

                        <form method="get" action="/resultado" class="card-body form-control-border p-3 p-sm-4">
                            @csrf
                            <div class="mb-3">
                                <label for="origen" class="form-label">Origen:</label>
                                <input class="form-control" list="origenes" name="origen"
                                    placeholder="Selecciona un origen" required>
                                <datalist id="origenes">
                                    @foreach ($origenes as $origen)
                                        <option value="{{ $origen->origen }}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="mb-3">
                                <label for="destino" class="form-label">Destino:</label>
                                <input class="form-control" list="destinos" name="destino"
                                    placeholder="Selecciona un destino" required>
                                <datalist id="destinos">
                                    @foreach ($destinos as $destino)
                                        <option value="{{ $destino->destino }}">
                                    @endforeach
                                </datalist>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Fecha:</label>
                                <input class="form-control" type="date" name="fecha_viaje" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-dark mb-0">Buscar</button>
                            </div>
                        </form>
                        <!-- Card-body END -->

                    </div>
                    <!-- Search END -->
                </div>
            </div> <!-- Row END -->
        </div>
        <!-- Modal para la informaciones del billete-->
        <div class="modal fade" id="Modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: rgb(49, 184, 208)">
                        <h1 class="modal-title fs-5 text-white" id="exampleModalLabel">confirmacion</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Nombre:</div>
                                <div class="col-md-8" id="nombre"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Dni:</div>
                                <div class="col-md-8" id="DNI"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">correo electronico:</div>
                                <div class="col-md-8" id="correo_electronico"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Numero bus:</div>
                                <div class="col-md-8" id="numero_bus"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Origen:</div>
                                <div class="col-md-8" id="origen"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Destino:</div>
                                <div class="col-md-8" id="destino"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Fecha Viaje:</div>
                                <div class="col-md-8" id="fecha_viaje"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Hora Salida:</div>
                                <div class="col-md-8" id="hora_viaje"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 font-weight-bold">Hora Llegada:</div>
                                <div class="col-md-8" id="hora_llegada"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
        <!-- Modal para alerta-->
        <div class="modal fade" id="Modal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-danger bg-danger text-white">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¡Alerta!</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Error al obtener las informaciónes del billete.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script>
        $(document).ready(function() {
            $('#buscarBtn').click(function() {

                var dni = $('#dni').val();
                $.ajax({
                    url: '/confirmacion/' + dni,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.reservacion && response.viaje) {
                            $('#id').text(response.reservacion.id);
                            $('#nombre').text(response.reservacion.nombre);
                            $('#DNI').text(response.reservacion.DNI);
                            $('#correo_electronico').text(response.reservacion
                                .correo_electronico);
                            $('#numero_bus').text(response.viaje.numero_bus);
                            $('#origen').text(response.viaje.origen);
                            $('#destino').text(response.viaje.destino);
                            $('#fecha_viaje').text(response.viaje.fecha_viaje);
                            $('#hora_viaje').text(response.viaje.hora_viaje);
                            $('#hora_llegada').text(response.viaje.hora_llegada);

                            $('#Modal1').modal('show');

                        } else {

                            alert('No se encontraron detalles del viaje');
                        }
                    },
                    error: function(response) {
                        $('#Modal2').modal('show');
                    }
                });
            });
        });
    </script>
@endsection
