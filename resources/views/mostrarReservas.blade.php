@extends('app')

@section('contenido')
    <div class="row" style="margin-top: 10%">
        <div class="col-6"> 
            <table class="table ">
                <thead >
                    <tr style="background: rgb(0,212,255);
                    background: linear-gradient(90deg, rgba(0,212,255,1) 61%, rgba(2,0,36,1) 95%);">
                        <th style="">ID</th>
                        <th>nombre</th>
                        <th>DNI</th>
                        <th>codigo postal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody> 
                     @foreach ($reserva as $res)  
                        <tr style="background: rgb(0,212,255);
                        background: linear-gradient(90deg, rgba(0,212,255,1) 61%, rgba(2,0,36,1) 95%);">
                            <td>{{ $res->id }}</td>
                            <td>{{ $res->nombre }}</td>
                            <td>{{ $res->DNI }}</td>
                            <td>{{ $res->codigo_postal }}</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-id=""
                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    detalle
                                </button>

                                <a href="/modificar/" class="btn btn-primary btn-sm">Modificar</a>
                                <form action="/mostrarViajes/" method="POST"
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
        <div class="col-6">
            <form>
                @csrf
                <div class="row shadow justify-content-center text-white mt-2"
                    style="background: rgb(2,0,36);
                    background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(15,123,143,1) 45%, rgba(0,212,255,1) 100%);;border-radius: 5px;width:90">
                    <div class="col-6">
                        <label for="nombre" class="form-label">nombre</label>
                        <input type="text" class="form-control" name="nombre">
                    </div>
                    <div class="col-6">
                        <label for="DNI" class="form-label">DNI</label>
                        <input type="text" class="form-control" name="DNI""  >
                    </div>
                    <div class="col-12">
                        <label for="correo_electronico" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="correo_electronico" >
                    </div>
                    <div class="col-12">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion"  placeholder="calle ..." >
                    </div>
                    <div class="col-6 mt-3">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad"  >
                    </div>
                    <div class="col-6 mt-3">
                        <label for="codigo_postal" class="form-label">Código Postal</label>
                        <input type="text" class="form-control" name="codigo_postal">
                    </div>
                    <div class="col-0 mt-3 mb-2">
                        <button type="submit" class="btn px-4 text-white" style="background: rgb(63,149,251);
                        background: radial-gradient(circle, rgba(63,149,251,1) 37%, rgba(85,70,252,1) 86%);">reservar</button>
                    </div>
                </div>
            </form>
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
    <script>
        function confirmarEliminacion() {
            return confirm('¿Estás seguro de que deseas eliminar este viaje?');
        }
    </script>
@endsection
