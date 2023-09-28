@extends('app')

@section('contenido')
    <div class="card" style="margin-top:7%">
        @if (session('mensaje'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('mensaje') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
            </div>
        @endif
        <div class="card-header" style="background-color: rgb(49, 184, 208)">
            <h1 class="text-center">Listado de Viajes</h1>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
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
                                <button type="button" class="btn btn-success btn-sm" data-id="{{ $viaj->id }}"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    detalle
                                </button>

                                <a href="/modificar/{{ $viaj->id }}" class="btn btn-primary btn-sm">Modificar</a>
                                <form action="/mostrarViajes/{{ $viaj->id }}" method="POST"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirmarEliminacion()"
                                        class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Modal -->
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
                        $('#num_asientos_dispo').text(response.num_asientos_dispo);
                    },
                    error: function(response) {
                        // Manejamos el error en caso de que la petición falle
                        alert('Error al obtener los detalles del viaje');
                    }
                });
            });
        });
    </script>
    <script>
        function confirmarEliminacion() {
            return confirm('¿Estás seguro de que deseas eliminar este viaje?');
        }
    </script>
@endsection
