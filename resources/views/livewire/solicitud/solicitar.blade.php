<div class="container">
    <div class="row d-flex justify-content-center">
        <h3 class="text-center mt-2 col-12">Solicitar Bienes</h3>
        <div class="card mt-2" style="max-height: 70vh;">
            <div class="card-header">
                <div class="text-center">
                    <input wire:model="nombre" type="text" class="form-control" placeholder="Buscar:">
                </div>
            </div>
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <tbody>
                    @foreach($equipos as $equipo)
                        <tr>
                            <td>{{ $equipo->nombre }}</td>
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#solicitar" wire:click="equipo({{ $equipo->id }})">Solicitar</button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="solicitar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title" id="exampleModalLabel">Solicitud de Bienes Nacionales</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <h5>Seleccione el usuario al cual se le asignará el bien:</h5>
                        
                        <select name="" id="user" class="form-control" wire:model="destinatario">
                            <option value="">-- Seleccionar --</option>                                
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" wire:click.defer="create()">Solicitar</button>
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
    
            window.addEventListener('solicitar', event => {

                $('#solicitar').modal('hide');
                toastr.success("El Equipo ha sido solicitado", "¡Hecho!");
            });

        });
    </script>

</div>
