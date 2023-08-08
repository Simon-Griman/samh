<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2">
            <div class="card-body">
                <div class="text-center">
                    <a wire:click="modalCrear()" class="btn btn-primary" data-toggle="modal" data-target="#crear">Nuevo Rol de Equipo</a>
                </div>
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $rol)
                        <tr>
                            <td>{{ $rol->rol }}</td>
                            <td>
                                <a wire:click="modalEditar({{ $rol->id }})" class="btn btn-success" data-toggle="modal" data-target="#crear">Editar</a>

                                <a wire:click="confirBorrar({{ $rol->id }})" class="btn btn-danger" data-toggle="modal" data-target="#borrar">Borrar</a>
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
                                <h5>¿Realmente desea borrar <b>{{ $rol_borrar }}</b> de la lista?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger" wire:click.defer="borrar()">Eliminar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="crear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            @if($crear)
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            @else
                            <div class="modal-header bg-success">
                                <h5 class="modal-title" id="exampleModalLabel">Actualizar Registro</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            @endif
                            <form>
                                <div class="modal-body">
                                    
                                    <div class="mb-3">
                                        <label for="rol" class="col-form-label">Nombre del Rol:</label>
                                        <input type="text" class="form-control @error('rol') is-invalid @enderror" id="rol" wire:model.defer="rol" name="rol" require value="{{ old('rol') }}">

                                        @error('rol')

                                        <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>

                                        @enderror
                                    </div>                                        
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    
                                    @if($crear)
                                    <button type="submit" class="btn btn-success" wire:click.prevent="crear()">Enviar</button>
                                    @else
                                    <button type="submit" class="btn btn-success" wire:click.prevent="editar()">Enviar</button>
                                    @endif
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('js/jquery.js') }}"></script>
    
    <script>
        $(document).ready(function() {

            toastr.options = {
                "positionClass": "toast-bottom-right",
                "progressBar": true,
                "closeButton": true,
            }
            window.addEventListener('crear', event => {
                $('#crear').modal('hide');
                toastr.success('El registro ha sido creado', "¡Hecho!");
            });

            window.addEventListener('editar', event => {
                $('#crear').modal('hide');
                toastr.success('El registro ha sido editado', "¡Hecho!");
            });

            window.addEventListener('borrar', event => {

                $('#borrar').modal('hide');
                toastr.success("El registro ha sido eliminado", "¡Hecho!");
            });

        });
    </script>
</div>