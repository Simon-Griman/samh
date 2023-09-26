<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card" style="max-height: 80vh;">

            <div class="car-header">
                <div class="text-center p-2" style="background-color: #eee;">
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo Usuario</a>
                </div>
            </div>
            
            <div class="card-body overflow-auto" >

                <table class="table table-responsive table-hover">
                    <thead>
                        <th><input wire:model="nombre" type="text" class="form-control" placeholder="Buscar:"><br>Nombre</th>
                        <th><input wire:model="email" type="text" class="form-control" placeholder="Buscar:"><br>Email</th>
                        <th><input wire:model="cedula" type="text" class="form-control" placeholder="Buscar:"><br>Cedula</th>
                        <th colspan="2" class="text-center">Acciones</th>                    
                    </thead>
                    @if ($users->count())
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->cedula }}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('users.edit', $user) }}">Editar</a>
                            </td>
                            <td>
                                <a class="btn btn-danger" wire:click="confirBorrar({{ $user->id }})" data-toggle="modal" data-target="#borrar">Eliminar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <h4 class="text-center">No se encontraron resultados</h4>
                            </td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            </div>
            <div class="card-footer">
                
                {{ $users->links() }}
            </div>

            <div class="modal fade" id="borrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <h5>¿Realmente desea borrar a <b>{{ $user_borrar }}</b> del sistema?</h5>
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
