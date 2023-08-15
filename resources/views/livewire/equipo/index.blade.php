<div class="container">
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
                            <th>
                                <select class="form-control" wire:model="rol">
                                    <option value="">Todo</option>                            
                                    @foreach ($roles as $role)
                                        @if ($role->rol != 'Disponible')
                                        <option value="{{ $role->rol }}">{{ $role->rol }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <br>Rol
                            </th>
                            <th>Observación</th>
                            <th>
                                <select class="form-control" wire:model="departamento">
                                    <option value="">Todo</option>
                                    @foreach ($departamentos as $departament)
                                        <option value="{{ $departament->nombre }}">{{ $departament->nombre }}</option>
                                    @endforeach
                                </select>
                                <br>Departamento
                            </th>
                            <th>
                                <select class="form-control" wire:model="usuario">                                
                                    <option value="">Todo</option>                            
                                    @foreach ($usuarios as $user)
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <br>Usuario
                            </th>
                            @can('users.index')
                            <th>Creado</th>
                            <th>Actulizado</th>
                            @endcan
                            <th colspan="2" class="text-center">Acciones</th>
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
                            <td>{{ $equipo->rol }}</td>
                            <td>{{ $equipo->observacion }}</td>
                            <td>{{ $equipo->departamento }}</td>
                            <td>{{ $equipo->name }}</td>
                            @can('users.index')
                            <td>{{ $equipo->creado }}</td>
                            <td>{{ $equipo->actualizado }}</td>
                            @endcan
                            <td style="padding: 2px;"><a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-primary"><i class="fas fa-pen"></i></a></td>
                            <td style="padding: 2px;">
                                <button class="btn btn-danger" wire:click="confirBorrar({{ $equipo->id }})" data-toggle="modal" data-target="#borrar"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
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
                                <h5>El usuario asignado perdera el equipo</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" wire:click.defer="borrar()">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('js/jquery.js') }}"></script>
    <script src="{{ url('js/toastr.js') }}"></script>
    <script>
        $(document).ready(function() {

            toastr.options = {
                "positionClass": "toast-bottom-right",
                "progressBar": true,
                "closeButton": true,
            }

            window.addEventListener('borrar', event => {

                $('#borrar').modal('hide');
                toastr.success("El registro ha sido eliminado", "¡Hecho!");
            });

        });
    </script>

</div>