@extends('app')

@section('contenido')
    <div class="row mt-5">
        <div class="col-6 " style="max-height:350px; overflow-y: auto;">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <table class="table">
                <thead style="position: sticky ;top:0px">
                    <tr
                        style="background: rgb(0,212,255);
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
                        <tr
                            style="background: rgb(0,212,255);
                        background: linear-gradient(90deg, rgba(0,212,255,1) 61%, rgba(2,0,36,1) 95%);">
                            <td>{{ $res->id }}</td>
                            <td>{{ $res->nombre }}</td>
                            <td>{{ $res->DNI }}</td>
                            <td>{{ $res->codigo_postal }}</td>
                            <td>
                                <button type="button" onclick="modificacion({{ $res->viaje_id }},{{ $res->id }});"
                                    class="btn btn-primary btn-sm">
                                    Modificar
                                </button>

                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#confirmModal{{ $res->id }}">
                                    Eliminar
                                </button>
                                <!-- Modal de confirmación de la eliminacion-->
                                <div class="modal fade" id="confirmModal{{ $res->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog  modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header  bg-danger text-white ">
                                                <h5 class="modal-title" id="exampleModalLabel">Confirmar Eliminación
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body ">
                                                <p>¿Estás seguro de que deseas eliminar este reservacion?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="/eliminarReserva/{{ $res->id }}/{{ $res->viaje_id }}"
                                                    method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirmarEliminacion()"
                                                        class="btn btn-danger ">Eliminar</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-6">
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
            <form method="POST" action="/modificarReserva">
                @csrf
                <div class="row shadow justify-content-center text-white"
                    style="background: rgb(2,0,36);
                    background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(15,123,143,1) 45%, rgba(0,212,255,1) 100%);;border-radius: 5px;width:90">
                    <input type="text" name="viaje_id" id="viaje_id" hidden>
                    <div class="col-2">
                        <label for="nombre" class="form-label">ID</label>
                        <input type="text" class="form-control" name="id" id="id" required>
                    </div>
                    <div class="col-5">
                        <label for="nombre" class="form-label">nombre</label>
                        <input type="text" class="form-control" name="nombre" required id="nombre">
                    </div>
                    <div class="col-5">
                        <label for="DNI" class="form-label">DNI</label>
                        <input type="text" class="form-control" name="DNI" required id="DNI">
                    </div>
                    <div class="col-12">
                        <label for="correo_electronico" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" name="correo_electronico" required
                            id="correo_electronico">
                    </div>
                    <div class="col-12">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="direccion" placeholder="calle ..." required
                            id="direccion">
                    </div>
                    <div class="col-6 mt-3">
                        <label for="ciudad" class="form-label">Ciudad</label>
                        <input type="text" class="form-control" name="ciudad" required id="ciudad">
                    </div>
                    <div class="col-6 mt-3">
                        <label for="codigo_postal" class="form-label">Código Postal</label>
                        <input type="text" class="form-control" name="codigo_postal" required id="codigo_postal">
                    </div>
                    <div class="col-0 mt-3 mb-2">
                        <button type="submit" class="btn px-4 text-white"
                            style="background: rgb(63,149,251);
                        background: radial-gradient(circle, rgba(63,149,251,1) 37%, rgba(85,70,252,1) 86%);">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function modificacion(idViaje,
            idReserva) {

            $.ajax({
                url: '/showReserva',
                type: 'get',
                dataType: 'json',
                data: {
                    param1: idReserva,
                    param2: idViaje
                },
                success: function(response) {
                    $('#viaje_id').val(response.viaje_id);
                    $('#id').val(response.id);
                    $('#DNI').val(response.DNI);
                    $('#nombre').val(response.nombre);
                    $('#correo_electronico').val(response.correo_electronico);
                    $('#direccion').val(response.direccion);
                    $('#ciudad').val(response.ciudad);
                    $('#codigo_postal').val(response.codigo_postal);

                },
                error: function(response) {
                    // Manejamos el error en caso de que la petición falle
                    alert('Error al obtener los detalles del viaje');
                }
            });

        }
    </script>
@endsection
