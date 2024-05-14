<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2" style="max-height: 75vh;">
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th wire:ignore>
                                <select class="form-control select2" id="equipo" wire:model="tipo">
                                    <option value="">Todo</option>                            
                                    @foreach ($tipos as $tipo)
                                        <option value="{{ $tipo->nombre }}">{{ $tipo->nombre }}</option>
                                    @endforeach
                                </select>
                                <br><br>Nombre
                            </th>
                            <th wire:ignore>
                                <select class="form-control select2" id="marca" wire:model="marca">
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
                            <th colspan="3">Acciones</th>
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
                            <td style="padding: 2px;"><a href="{{ route('inventario.edit', $equipo->id) }}" class="btn btn-primary"><i class="fas fa-pen"></i></a></td>
                            <td style="padding: 2px;">
                                <a href="{{ route('inventario.show', $equipo->id) }}" class="btn btn-secondary" title="ver"><i class="fas fa-eye"></i></a>
                            </td>
                            <td style="padding: 2px;">
                                <button class="btn btn-danger" wire:click="confirBorrar({{ $equipo->id }})" data-toggle="modal" data-target="#borrar"><i class="fas fa-trash"></i></button>
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
            </div>
            <div class="card-footer">
                {{ $equipos->links() }}
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

            $('#equipo').on('change', function(){
                @this.set('tipo', this.value);
            });

            $('#marca').on('change', function(){
                @this.set('marca', this.value);
            });
        });
    
    </script>

</div>