<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2">
            <div class="card-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Solicitante</th>
                            <th>Usuario</th>
                            @can('users.index')
                            <th colspan="2"></th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($solicitudes as $solicitud)
                        <tr>
                            <td>{{ $solicitud->equipo }}</td>

                            @foreach($solicitante as $destino)
                                @if($destino->id == $solicitud->id)
                                <td>{{ $destino->solicitante }}</td>
                                @endif
                            @endforeach

                            <td>{{ $solicitud->user }}</td>
                            @can('users.index')
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#solicitar" wire:click="asignar({{ $solicitud->id_equipo }}, {{ $solicitud->id_user }}, {{ $solicitud->id }})">Aceptar</button></td>
                            <td><button class="btn btn-danger" data-toggle="modal" data-target="#solicitar" wire:click="rechazar({{ $solicitud->id }})">Rechazar</button></td>
                            @endcan
                        </tr>    
                    @endforeach
                    </tbody>
                </table>
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
    
            window.addEventListener('aceptado', event => {

                toastr.success("El Equipo ha sido asignado correctamente", "¡Hecho!");
            });

            window.addEventListener('rechazado', event => {

                toastr.info("La petición ha sido rechazada", "¡Hecho!");
            });

            
            window.addEventListener('vacio', event => {

                toastr.error("No hay equipos disponibles actualmente", "¡Sin Inventario!");
            });
        });
    </script>
</div>