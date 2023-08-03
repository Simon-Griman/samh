<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2">
            <div class="card-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Marca</th>
                            <th colspan="3" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($marcas as $marca)
                        <tr>
                            <td><strong>{{ $marca->nombre }}</strong></td>
                            <td><button class="btn btn-primary" data-toggle="modal" data-target="#crear" wire:click="modalCrear({{ $marca->id }})">Nuevo</button></td>
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#actualizar" wire:click="modalEditar({{ $marca->id }})">Editar</button></td>
                            <td><button wire:click="confirBorrar({{ $marca->id }})" class="btn btn-danger" data-toggle="modal" data-target="#borrar">Borrar</button></td>
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

                                <label for="borrar" class="col-form-label">Elige el modelo a eliminar</label>

                                <select class="form-control @error('borrar') is-invalid @enderror" id="borrar" wire:model.defer="borrar" name="borrar" require>

                                    <option value="">-- Seleccionar --</option>

                                    @foreach($modelos as $modelo)

                                    @if($id_marca == $modelo->marca_id)
                                    <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                                    @endif

                                    @endforeach
                                </select>

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
                            
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $nombre_marca }}</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <form>
                                <div class="modal-body">
                                    
                                    <div class="mb-3">
                                        <label for="marca" class="col-form-label">Nombre del Modelo:</label>
                                        
                                        <input type="text" class="form-control @error('modelo') is-invalid @enderror" id="modelo" name="modelo" require value="{{ old('modelo') }}" wire:model.defer="modelo">

                                        @error('modelo')

                                        <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>

                                        @enderror
                                    </div>                                        
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    
                                    <button type="submit" class="btn btn-success" wire:click.prevent="crear()">Enviar</button>                 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="actualizar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            
                            <div class="modal-header bg-success">
                                <h5 class="modal-title" id="exampleModalLabel">{{ $nombre_marca }}</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <form>
                                <div class="modal-body">
                                    
                                    <div class="mb-3">
                                        <label for="marca" class="col-form-label">Nombre del Modelo:</label>

                                        <select class="form-control @error('id_modelo') is-invalid @enderror" id="id_modelo" wire:model.defer="id_modelo" name="id_modelo" require>

                                            <option value="">-- Seleccionar --</option>

                                            @foreach($modelos as $modelo)

                                            @if($id_marca == $modelo->marca_id)
                                            <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                                            @endif

                                            @endforeach
                                        </select>

                                        @error('id_modelo')

                                        <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>

                                        @enderror

                                        <label for="modelo" class="col-form-label">Nuevo Nombre del Modelo:</label>

                                        <input type="text" class="form-control @error('modelo') is-invalid @enderror" id="modelo" name="modelo" require value="{{ old('modelo') }}" wire:model.defer="modelo">

                                        @error('modelo')

                                        <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>

                                        @enderror
                                    </div>                                        
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    
                                    
                                    <button type="submit" class="btn btn-success" wire:click.prevent="editar()">Enviar</button>
                                    
                                    
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    
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
                $('#actualizar').modal('hide');
                toastr.success('El registro ha sido editado', "¡Hecho!");
            });

            window.addEventListener('borrar', event => {

                $('#borrar').modal('hide');
                toastr.success("El registro ha sido eliminado", "¡Hecho!");
            });

        });
    </script>
</div>
