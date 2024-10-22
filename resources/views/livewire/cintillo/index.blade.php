<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-4" style="max-height: 75vh;">
            <div class="card-header" style="background-color: #eee;">
                <div class="text-center">
                    <a class="btn btn-primary" data-toggle="modal" data-target="#crear">Nuevo Cintillo</a>
                </div>
            </div>
            
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Cintillo</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cintillos as $item)
                        <tr>
                            <td><img src="{{ url('storage/' . $item->nombre) }}" alt="" class="cintillo" style="width:100%"></td>
                            <td>
                                <a wire:click="modalActivar({{ $item->id }})" class="btn btn-success" data-toggle="modal" data-target="#activar">Activar</a>
                            </td>
                            <td>
                                <a wire:click="confirBorrar({{ $item->id }})" class="btn btn-danger" data-toggle="modal" data-target="#borrar">Borrar</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="modal fade" id="activar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h5 class="modal-title" id="exampleModalLabel">Activar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <h5>¿Realmente desea activar el cintillo: <b>{{ $cintillo_activar }}?</b></h5>
                                <p>Este cintillo se vera en todas las pestañas y archivos</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-success" wire:click.defer="activar()">Activar</button>
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
                                <h5>¿Realmente desea borrar <b>{{ $cintillo_title }}</b> de la lista?</h5>
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
                                <h5 class="modal-title" id="exampleModalLabel">Subir Cintillo</h5>
                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <form wire:submit.prevent="up">
                                <div class="m-2">
                                    <input type="file" wire:model="cintillo">
                                    @error('cintillo') <span class="error text-red">{{ $message }}</span> @enderror
                                </div>
                                <div class="m-2">
                                    <label for="title">Titulo de la Imagen</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" wire:model.defer="title">
                                    @error('title')
                                        <span class="invalid-feedback">
                                            <strong>{{$message}}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-2 text-center">
                                    <button type="submit" class="btn btn-primary">Subir Imagen</button>
                                </div>
                            </form>
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
            window.addEventListener('crear', event => {
                $('#crear').modal('hide');
                toastr.success('El registro ha sido creado', "¡Hecho!");
            });

            window.addEventListener('editar', event => {
                $('#activar').modal('hide');
                toastr.success('El registro ha sido editado', "¡Hecho!");
            });

            window.addEventListener('borrar', event => {

                $('#borrar').modal('hide');
                toastr.success("El registro ha sido eliminado", "¡Hecho!");
            });

            window.addEventListener('borrar_activo', event => {

                $('#borrar').modal('hide');
                toastr.error("La imagen esta activa, no se puede eliminar", "Advertencia");
            });

        });
    </script>
</div>
