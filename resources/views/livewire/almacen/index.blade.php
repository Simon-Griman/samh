<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2" style="max-height: 75vh;">
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th wire:ignore>
                                <select class="form-control select2" id="descripcion" wire:model="descripcion">
                                    <option value="">Todo</option>                            
                                    @foreach ($articulos as $articulo)
                                        <option value="{{ $articulo->nombre }}">{{ $articulo->nombre }}</option>
                                    @endforeach
                                </select>
                                <br><br>Descripción
                            </th>
                            <th>
                                <select class="form-control" id="descripcion" wire:model="unidad2">
                                    <option value="">Todo</option>
                                    <option value="Caja">Caja</option>
                                    <option value="Unidad">Unidad</option>
                                </select>
                                <br>Tipo Unidad
                            </th>
                            <th>Cantidad</th>
                            <th colspan="2">Movimientos</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($almacen as $alma)
                        <tr>
                            <td>{{ $alma->nombre }}</td>
                            <td>{{ $alma->tipo_unidad }}</td>
                            <td>{{ $alma->total }}</td>
                            <td style="padding: 2px;">
                                <button class="btn btn-primary" wire:click="entrada('{{ $alma->nombre }}', '{{ $alma->tipo_unidad }}')" data-toggle="modal" data-target="#entrada" title="entrada"><i class="fas fa-plus"></i></button>
                            </td>
                            <td style="padding: 2px;">
                                <button class="btn btn-danger" wire:click="salida('{{ $alma->nombre }}', '{{ $alma->tipo_unidad }}')" data-toggle="modal" data-target="#salida" title="salida"><i class="fas fa-minus"></i></button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                {{--{{ $almacen->links() }}--}}

                <button class="btn btn-info" data-toggle="modal" data-target="#registro"><i class="fas fa-eye"></i> Todos los Registros</button>
            </div>
        </div>

        <div class="modal fade" id="entrada" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Entrada de {{ $nombre }}</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="datos-entrada" class="col-form-label">Cantidad a Ingresar:</label>
                                
                                <input type="number" class="form-control @error('entrada') is-invalid @enderror" id="datos-entrada" wire:model.defer="entrada">

                                @error('entrada')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success" wire:click.prevent="entrada_crear()">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="salida" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title" id="exampleModalLabel">Salida de {{ $nombre }}</h5>
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="salida" class="col-form-label">Cantidad a Retirar:</label>
                                
                                <input type="datos-salida" class="form-control @error('salida') is-invalid @enderror" id="datos-salida" wire:model.defer="salida">

                                @error('salida')
                                <span class="invalid-feedback">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success" wire:click.prevent="salida_crear()">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="registro" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>

            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h3 class="modal-title"><b>Registro de Movimientos</b></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Unidad</th>
                                    <th>Entrada</th>
                                    <th>Fecha Entrada</th>
                                    <th>Salida</th>
                                    <th>Fecha Salida</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($registros as $registro)
                                <tr>
                                    <td>{{ $registro->nombre }}</td>
                                    <td>{{ $registro->tipo_unidad }}</td>
                                    <td>{{ $registro->entrada }}</td>
                                    <td>{{ $registro->fecha_entrada }}</td>
                                    <td>{{ $registro->salida }}</td>
                                    <td>{{ $registro->fecha_salida }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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

            window.addEventListener('crear', event => {

                $('#entrada').modal('hide');
                toastr.success("Se ha registrado la entrada", "¡Hecho!");
            });

            window.addEventListener('borrar', event => {

                $('#salida').modal('hide');
                toastr.success("Se ha registrado la salida", "¡Hecho!");
            });

            $(function () {
                $('#entrada').on('shown.bs.modal', function (e) {
                    $('#datos-entrada').focus();
                })
            });

            $(function () {
                $('#salida').on('shown.bs.modal', function (e) {
                    $('#datos-salida').focus();
                })
            });
        });
        
        document.addEventListener('livewire:load', function(){

            $('.select2').select2();

            $('#descripcion').on('change', function(){
                @this.set('descripcion', this.value);
            });
        });
    
    </script>

</div>