<div class="">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2" style="max-height: 75vh;">
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th wire:ignore>
                                
                                <select class="form-control select2" id="sel1" wire:model="tipo">
                                    <option value="">Todo</option>                            
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->nombre }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                                <br><br>Nombre
                            </th>
                            <th wire:ignore>
                                <select class="form-control select2" id="sel2" wire:model="marca">
                                    <option value="">Todo</option>                            
                                    @foreach ($marcas as $marca)
                                        <option value="{{ $marca->nombre }}">{{ $marca->nombre }}</option>
                                    @endforeach
                                </select>
                                <br><br>Marca
                            </th>
                            <th><input wire:model="modelo" type="text" class="form-control" placeholder="Buscar:"><br>Modelo</th>
                            <th><input wire:model="serial" type="text" class="form-control" placeholder="Buscar:"><br>Serial</th>
                            <th><input wire:model="bien_nacional" type="text" class="form-control" placeholder="Buscar:"><br>Bien N.</th>
                            <th wire:ignore>
                                <select class="form-control select2" id="sel3" wire:model="rol">
                                    <option value="">Todo</option>                            
                                    @foreach ($roles as $role)
                                        @if ($role->rol != 'Disponible')
                                        <option value="{{ $role->rol }}">{{ $role->rol }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <br><br>Rol
                            </th>
                            <th wire:ignore>
                                <select class="form-control select2" id="sel4" wire:model="departamento">
                                    <option value="">Todo</option>
                                    @foreach ($departamentos as $departament)
                                        <option value="{{ $departament->nombre }}">{{ $departament->nombre }}</option>
                                    @endforeach
                                </select>
                                <br><br>Departamento
                            </th>
                            <th wire:ignore>
                                <select class="form-control select2" id="sel5" wire:model="usuario"> 
                                    <option value="">Todo</option>                            
                                    @foreach ($usuarios as $user)
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <br><br>Usuario
                            </th>
                            <th wire:ignore>
                                <select class="form-control select2" id="sel6" wire:model="ubicacion">
                                    <option value="">Todo</option>                            
                                    @foreach ($ubicaciones as $ubica)
                                        <option value="{{ $ubica->nombre }}">{{ $ubica->nombre }}</option>
                                    @endforeach
                                </select>
                                <br><br>ubicación
                            </th>
                            <th colspan="3" class="text-center">Acciones</th>
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
                            <td>{{ $equipo->departamento }}</td>
                            <td>{{ $equipo->name }}</td>
                            <td>{{ $equipo->ubicacion }}</td>
                            <td style="padding: 2px;">
                                <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-primary" title="editar"><i class="fas fa-pen"></i></a>
                            </td>
                            
                            <td style="padding: 2px;">
                                <a href="{{ route('equipos.show', $equipo->id) }}" class="btn btn-secondary" title="ver"><i class="fas fa-eye"></i></a>
                            </td>
                            
                            <td style="padding: 2px;">
                                <button class="btn btn-danger" wire:click="confirBorrar({{ $equipo->id }})" data-toggle="modal" data-target="#borrar" title="borrar"><i class="fas fa-trash"></i></button>
                            </td>
                            @if($equipo->equipo == 'Computadora')
                            <td style="padding: 2px;">
                                <button class="btn btn-info" wire:click="agregar({{ $equipo->id }}, {{ $equipo->id_marca }})" data-toggle="modal" data-target="#dependiente"><i class="fas fa-plus"></i></button>
                            </td>
                            @endif
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

                <div class="modal fade" id="dependiente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="exampleModalLabel">Añadir Periferico</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nombre" class="col-form-label">Nombre:</label>
                                    
                                    <select name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" wire:model.defer="nombre">
                                        <option value="">-- Seleccionar --</option>
                                        <option value="Teclado">Teclado</option>
                                        <option value="Mouse">Mouse</option>
                                        <option value="Cornetas">Cornetas</option>
                                    </select>

                                    @error('nombre')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="marca_id" class="col-form-label">Marca:</label>

                                    <select class="form-control select2 @error('marca_id') is-invalid @enderror" id="marca_id" wire:model.defer="marca_id">
                                        <option value="">-- Seleccionar --</option>                            
                                        @foreach ($marcas as $marca)
                                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                                        @endforeach
                                    </select>

                                    @error('marca_id')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="modelo" class="col-form-label">Modelo:</label>

                                    <select class="form-control select2 @error('modelo_id') is-invalid @enderror" id="modelo" wire:model.defer="modelo_id">
                                        <option value="">-- Seleccionar --</option>                            
                                        @foreach ($modelos as $modelo)
                                            @if($modelo->nombre != 'S/M')
                                            <option value="{{ $modelo->id }}">{{ $modelo->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>

                                    @error('modelo_id')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="serial">Serial: </label>

                                    <input type="text" class="form-control @error('serial_dependiente') is-invalid @enderror" id="serial" wire:model.defer="serial_dependiente">

                                    @error('serial_dependiente')
                                    <span class="invalid-feedback">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success" wire:click.prevent="crear()">Añadir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            </div>
            <div class="card-footer">
                {{ $equipos->links() }}
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

            window.addEventListener('crear', event => {

                $('#dependiente').modal('hide');
                toastr.success("El periferico ha sido añadido con exito", "¡Hecho!");
            });
            
        });

        document.addEventListener('livewire:load', function(){
            $('.select2').select2();

            $('#sel1').on('change', function(){
                @this.set('tipo', this.value);
            });

            $('#sel2').on('change', function(){
                @this.set('marca', this.value);
            });

            $('#sel3').on('change', function(){
                @this.set('rol', this.value);
            });

            $('#sel4').on('change', function(){
                @this.set('departamento', this.value);
            });

            $('#sel5').on('change', function(){
                @this.set('usuario', this.value);
            });

            $('#sel6').on('change', function(){
                @this.set('ubicacion', this.value);
            });
        });
    </script>

</div>