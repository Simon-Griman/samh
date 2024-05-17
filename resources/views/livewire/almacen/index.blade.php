<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2" style="max-height: 75vh;">
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                        <th wire:ignore>
                            <select class="form-control select2" id="descripcion" wire:model="tipo">
                                <option value="">Todo</option>                            
                                @foreach ($articulos as $articulo)
                                    <option value="{{ $articulo->nombre }}">{{ $articulo->nombre }}</option>
                                @endforeach
                            </select>
                            <br><br>Descripción
                        </th>
                            <th><input wire:model="tipo_unidad" type="text" class="form-control" placeholder="Buscar:"><br>Tipo de Unidad</th>
                            <th><input wire:model="fecha_entrada" type="text" class="form-control" placeholder="Buscar:"><br>Entrada</th>
                            <th>Fecha Entrada</th>
                            <th>Salida</th>
                            <th>Fecha Salida</th>
                            <th>Cantidad</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($almacen as $articulo)
                        <tr>
                            <td>{{ $articulo->nombre }}</td>
                            <td>{{ $articulo->tipo_unidad }}</td>
                            <td>{{ $articulo->entrada }}</td>
                            <td>{{ $articulo->fecha_entrada }}</td>
                            <td>{{ $articulo->salida }}</td>
                            <td>{{ $articulo->fecha_salida }}</td>
                            <td>{{ $articulo->entrada - $articulo->salida }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{--{{ $almacen->links() }}--}}
            </div>
        </div>

        {{--<div class="modal fade" id="borrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
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
        </div>--}}
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
        
        document.addEventListener('livewire:load', function(){
            $('.select2').select2();

            $('#descripcion').on('change', function(){
                @this.set('tipo', this.value);
            });

            $('#marca').on('change', function(){
                @this.set('marca', this.value);
            });
        });
    
    </script>

</div>