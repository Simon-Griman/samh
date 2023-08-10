<div class="container">
    <div class="text-center">
        <a class="btn btn-danger" data-toggle="modal" data-target="#borrartodo">Borrar Todo</a>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="card mt-2">
            <div class="card-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>
                                <select class="form-control" wire:model="tipo">
                                    <option value="">Todo</option>                            
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->nombre }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                                <br>Equipo
                            </th>
                            <th>
                                <select class="form-control" wire:model="marca">
                                    <option value="">Todo</option>                            
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->nombre }}">{{ $marca->nombre }}</option>
                                    @endforeach
                                </select>
                                <br>Marca
                            </th>
                            <th><input wire:model="modelo" type="text" class="form-control" placeholder="Buscar:"><br>Modelo</th>
                            <th><input wire:model="serial" type="text" class="form-control" placeholder="Buscar:"><br>Serial</th>
                            <th><input wire:model="bien_nacional" type="text" class="form-control" placeholder="Buscar:"><br>Bien N.</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($equipos as $equipo)
                        <tr>
                            <td>{{ $equipo->equipo }}</td>
                            <td>{{ $equipo->marca }}</td>
                            <td>{{ $equipo->modelo }}</td>
                            <td>{{ $equipo->serial }}</td>
                            <td>{{ $equipo->bien_nacional }}</td>
                            <td style="padding: 2px;"><a wire:click="confirReincorporar({{ $equipo->id }})" class="btn btn-success" data-toggle="modal" data-target="#crear" title="reincorporar"><i class="fas fa-arrow-up"></i></a></td>
                            <td style="padding: 2px;">
                                <button class="btn btn-danger" wire:click="confirBorrar({{ $equipo->id }})" data-toggle="modal" data-target="#borrar" title="borrar"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="crear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" id="exampleModalLabel">Reincorporar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <h5>
                            ¿Realmente desea reincorporar el <b>bien nacional</b>: 
                            @if ($bn_reincorporar != '')
                                <b>{{ $bn_reincorporar }}</b>?
                            @else
                                <i>"sin bien nacional"?</i>
                            @endif
                        </h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" wire:click.defer="reincorporar()">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="borrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <h5>
                            ¿Realmente desea borrar el <b>bien nacional</b>: 
                            @if ($bn_borrar != '')
                                <b>{{ $bn_borrar }}</b>?
                            @else
                                <i>"sin bien nacional"?</i>
                            @endif
                        </h5>
                        <h5>El Equipo quedara <b>permanentemente borrado</b></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" wire:click.defer="borrar()">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="borrartodo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <h5>
                            ¿Realmente desea borrar <b>Todos los equipos</b> de esta lista?
                        </h5>
                        <h5>Los equipos quedaran <b>permanentemente borrados</b></h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" wire:click.defer="borrarTodo()">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('js/jquery.js') }}"></script>
    <script src="{{ url('js/toastr.js') }}"></script>
    <script src="{{ url('js/sweetalert2.js') }}"></script>
    <script>
        $(document).ready(function() {

            toastr.options = {
                "positionClass": "toast-bottom-right",
                "progressBar": true,
                "closeButton": true,
            }

            window.addEventListener('editar', event => {
                $('#crear').modal('hide');
                toastr.success('El registro ha sido reincorporado', "¡Hecho!");
            });

            window.addEventListener('borrar', event => {

                $('#borrar').modal('hide');
                toastr.success("El registro ha sido eliminado permanentemente", "¡Hecho!");
            });

            window.addEventListener('borrarTodo', event => {

                $('#borrartodo').modal('hide');
                Swal.fire(
                    "¡Hecho!",
                    "Todos los registros han sido eliminados de forma permanente",
                    "success"
                )
            });

            window.addEventListener('sinRegistros', event => {

                $('#borrartodo').modal('hide');
                Swal.fire(
                    "Nada que borrar",
                    "No hay registros que borrar",
                    "warning"
                )
            });

        });
    </script>

</div>