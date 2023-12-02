@extends('app')
@section('contenido')
    <div class="mb-2 mt-5">
        @if (session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('reservas'))
            <div class="toast-container position-fixed bottom-0 end-0 p-4">
                <div id="liveToast" class="toast fade show d-flex text-bg-secondary" role="alert" aria-live="assertive"
                    aria-atomic="true">
                    <div class="toast-body ">
                        {{ session('reservas') }}
                    </div>
                    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header" style="background-color:black">
                <h1 class="text-center" style="color:rgb(255, 255, 255)">Listado de Viajes</h1>
            </div>
            <div class="card-body
                    pt-0" style="max-height:350px; overflow-y: auto;">

                <table class="table table-striped ">
                    <thead class="bg-white text-black" style="position: sticky ;top:0px">
                        <tr>
                            <th>Origen</th>
                            <th>Destino</th>
                            <th>fecha viaje</th>
                            <th>Hora Salida</th>
                            <th>Hora Llegada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($viajes as $viaj)
                            <tr>
                                <td>{{ $viaj->origen }}</td>
                                <td>{{ $viaj->destino }}</td>
                                <td>{{ $viaj->fecha_viaje }}</td>
                                <td>{{ $viaj->hora_viaje }}</td>
                                <td>{{ $viaj->hora_llegada }}</td>
                                <td>
                                    <!-- button para mostrar informciones del viaje-->
                                    <button type="button" class="btn btn-success btn-sm" data-id="{{ $viaj->id }}"
                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        detalle
                                    </button>
                                    <!-- button para le modificacion del viaje-->
                                    <a href="/modificar/{{ $viaj->id }}" class="btn btn-primary btn-sm">Modificar</a>
                                    <!-- button para le eliminacion del viaje-->
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#confirmModal{{ $viaj->id }}">
                                        Eliminar
                                    </button>

                                    <!-- Modal de confirmación de la eliminacion-->
                                    <div class="modal fade" id="confirmModal{{ $viaj->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>¿Estás seguro de que deseas eliminar este viaje?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="/mostrarViajes/{{ $viaj->id }}" method="POST"
                                                        style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- button para mostrar reservaciones-->
                                    <form action="/mostrarReservas/{{ $viaj->id }}" method="GET"
                                        style="display: inline-block;">
                                        <button type="submit" class="btn btn-info btn-sm ">reservaciones</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar informaciones del viaje-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(79, 218, 207)">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">detalle de viaje</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">id:</div>
                            <div class="col-md-8" id="id"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">numero_bus:</div>
                            <div class="col-md-8" id="numero_bus"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">num_asientos_dispo:</div>
                            <div class="col-md-8" id="num_asientos_dispo"></div>
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
                        <div class="row">
                            <div class="col-md-4 font-weight-bold">duracion:</div>
                            <div class="col-md-8" id="duracion"></div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <script>
        $(document).ready(function() {
            // Cuando se muestra el modal
            $('#exampleModal').on('show.bs.modal', function(event) {
                // Obtenemos el botón que disparó el evento
                var button = $(event.relatedTarget);
                // Obtenemos el ID del viaje
                var idViaje = button.data('id');
                // Hacemos la petición al servidor para obtener los detalles del viaje
                $.ajax({
                    url: '/mostrarViajes/' + idViaje,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Actualizamos los campos en el modal con los datos recibidos
                        $('#id').text(response.id);
                        $('#origen').text(response.origen);
                        $('#destino').text(response.destino);
                        $('#fecha_viaje').text(response.fecha_viaje);
                        $('#hora_viaje').text(response.hora_viaje);
                        $('#hora_llegada').text(response.hora_llegada);
                        $('#duracion').text(response.duracion);
                        $('#precio').text(response.precio);
                        $('#numero_bus').text(response.numero_bus);
                        $('#num_asientos_dispo').text(response.num_asientos);
                    },
                    error: function(response) {
                        // Manejamos el error en caso de que la petición falle
                        alert('Error al obtener los detalles del viaje');
                    }
                });
            });
        });
    </script>
@endsection
