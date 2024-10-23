<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2 col col-lg-9 mx-auto">
            <div class="card-body pb-0 w-100">            
                <table class="table">
                    <tr>
                        <td>Nombre:</td>
                        <td>{{ $datos->equipo }}</td>
                    </tr>
                    <tr>
                        <td>Marca:</td>
                        <td>{{ $datos->marca }}</td>
                    </tr>
                    <tr>
                        <td>Modelo:</td>
                        <td>{{ $datos->modelo }}</td>
                    </tr>
                    <tr>
                        <td>Serial:</td>
                        <td>{{ $datos->serial }}</td>
                    </tr>
                    <tr>
                        <td>Bien Nacional:</td>
                        <td>{{ $datos->bien_nacional }}</td>
                    </tr>
                    <tr>
                        <td>Bien Nacional PDVSA</td>
                        <td>{{ $equipo->bien_pdvsa }}</td>
                    </tr>
                    <tr>
                        <td>Bien Nacional Menpet</td>
                        <td>{{ $equipo->bien_menpet }}</td>
                    </tr>
                    <tr>
                        <td>Estado del Equipo:</td>
                        <td>{{ $datos->rol }}</td>
                    </tr>
                    <tr>
                        <td>Departamento:</td>
                        <td>{{ $datos->departamento }}</td>
                    </tr>
                    <tr>
                        <td>Usuario</td>
                        <td>{{ $datos->usuario }}</td>
                    </tr>
                    <tr>
                        <td>Observaciones:</td>
                        <td>{{ $datos->observacion }}</td>
                    </tr>
                    <tr>
                        <td>Ubicaión:</td>
                        <td>{{ $datos->ubicacion }}</td>
                    </tr>
                    <tr>
                        <td>Fecha de Adquisición:</td>
                        @if ($datos->fecha_adquisicion)
                        <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($datos->fecha_adquisicion))->format('d-m-Y') }}</td>
                        @else
                        <td></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Costo de Compra (Bolivares)</td>
                        <td>{{ $datos->costo_compra }}</td>
                    </tr>
                    <tr>
                        <td>Tiempo de Depreciación (Meses):</td>
                        <td>{{ $datos->depreciacion }}</td>
                    </tr>
                    <tr>
                        <td>Depreciación Mensual (Bolivares):</td>
                        <td>{{ $depreciacion }}</td>
                    </tr>
                    <tr>
                        <td>Depreciación Acumulada (Meses):</td>
                        @if ($datos->depreciacion)
                        <td class="@if ($d_mensual >= $datos->depreciacion) text-danger @endif">{{ $d_mensual }}</td>
                        @else
                        <td></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Depreciación Acumulada (Bolivares):</td>
                        <td>{{ $d_bolivares }}</td>
                    </tr>
                    <tr>
                        <td>Valor Actual (Bolivares)</td>
                        <td>{{ $precio_actual }}</td>
                    </tr>
                    <tr>
                        <td>Proveedor:</td>
                        <td>{{ $datos->proveedor }}</td>
                    </tr>
                    @can('user-index')
                    <tr>
                        <td>Creado por:</td>
                        <td>{{ $datos->creado }} <br> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($datos->f_creado))->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Actualizado por:</td>
                        <td>{{ $equipo->actualizado }} <br> @if($datos->actualizado){{ \Carbon\Carbon::createFromTimeStamp(strtotime($datos->f_actualizado))->format('d-m-Y') }}@endif</td>
                    </tr>
                    @endcan

                    @if($perifericos)
                        @foreach ($dependientes as $dependiente)
                        <tr>
                            <td colspan="2" align="center"><strong>Periferico {{ $cont }}</strong></td>
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td>{{ $dependiente->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Marca:</td>
                            <td>{{ $dependiente->marca }}</td>
                        </tr>
                        <tr>
                            <td>Modelo:</td>
                            <td>{{ $dependiente->modelo }}</td>
                        </tr>
                        <tr>
                            <td>Serial:</td>
                            <td>{{ $dependiente->serial }}</td>
                        </tr>
                        <tr class="text-center">
                            <td colspan="2">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#editar" wire:click="modalEditar({{ $dependiente->id }})">Actualizar</button>
                                <button class="btn btn-danger" wire:click="modalBorrar({{ $dependiente->id }})" data-toggle="modal" data-target="#borrar">Eliminar</button>
                            </td>
                        </tr>

                        @php $cont++ @endphp
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
        <div class="text-center col-12 mb-4">
            <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-primary" title="editar">Actualizar</a>
            <a href="{{ route('equipos.index') }}" class="btn btn-danger">Volver</a>
        </div>
    </div>
    @if($perifericos)
    <div class="modal fade" id="borrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h5>
                        ¿Realmente desea borrar el <b>periférico: {{ $periferico_borrar }}</b>? 
                    </h5>
                    <h5>El usuario asignado perdera el periférico</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" wire:click.defer="borrar()">Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Periferico</h5>
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
                        <button type="submit" class="btn btn-success" wire:click.prevent="editar()">Añadir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

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

            window.addEventListener('editar', event => {

                $('#editar').modal('hide');
                toastr.success("El periferico ha sido actualizado con exito", "¡Hecho!");
            });
            
        });
    </script>
</div>