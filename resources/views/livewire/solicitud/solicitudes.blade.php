<div class="container">

    <div class="row d-flex justify-content-center">
        @can('users.index')
        
        <h3 class="text-center mt-2 col-12">Solicitudes</h3>

        <div class="card">
            <div class="card-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Solicitante</th>
                            <th>Usuario</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($solicitudes as $solicitud)
                        @if($solicitud->estado == 1)
                        <tr>
                            <td>{{ $solicitud->equipo }}</td>

                            @foreach($solicitante as $destino)
                                @if($destino->id == $solicitud->id)
                                <td>{{ $destino->solicitante }}</td>
                                @endif
                            @endforeach

                            <td>{{ $solicitud->user }}</td>
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#solicitar" wire:click="asignar({{ $solicitud->id_equipo }}, {{ $solicitud->id_user }}, {{ $solicitud->id }})">Aceptar</button></td>
                            <td><button class="btn btn-danger" data-toggle="modal" data-target="#solicitar" wire:click="rechazar({{ $solicitud->id }})">Rechazar</button></td>
                            
                        </tr>   
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-center">
                <button class="btn btn-primary" data-toggle="modal" data-target="#historial">Historial</button>
            </div>
        </div>
        
        @endcan
        
        @can('users.index')

        <div class="modal fade" id="historial" tabindex="-1" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>

        @endcan

            <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h3 class="modal-title"><b>@can('users.index') Historial @else Estatus de Solicitudes @endcan</b></h3>
                        @can('users.index')
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        @endcan
                    </div>
                    
                    <div class="modal-body">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>Equipo</th>
                                    <th>Solicitante</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($solicitudes as $solicitud)
                                @can('users.index')

                                <tr class="@if($solicitud->estado == 2) bg-success @elseif($solicitud->estado == 3) bg-danger @elseif($solicitud->estado == 1) bg-secondary @endif">
                                    <td>{{ $solicitud->equipo }}</td>

                                    @foreach($solicitante as $destino)
                                        @if($destino->id == $solicitud->id)
                                        <td>{{ $destino->solicitante }}</td>
                                        @endif
                                    @endforeach

                                    <td>{{ $solicitud->user }}</td>

                                    @if($solicitud->estado == 1)
                                    <td>En Proceso</td>
                                    @elseif($solicitud->estado == 2)
                                    <td>Aceptado</td>
                                    @else
                                    <td>Rechazado</td>
                                    @endif
                                </tr>  

                                @else
                                
                                @if($solicitud->departamento_id == $departamento)

                                <tr class="@if($solicitud->estado == 2) bg-success @elseif($solicitud->estado == 3) bg-danger @elseif($solicitud->estado == 1) bg-secondary @endif">
                                    <td>{{ $solicitud->equipo }}</td>

                                    @foreach($solicitante as $destino)
                                        @if($destino->id == $solicitud->id)
                                        <td>{{ $destino->solicitante }}</td>
                                        @endif
                                    @endforeach

                                    <td>{{ $solicitud->user }}</td>

                                    @if($solicitud->estado == 1)
                                    <td>En Proceso</td>
                                    @elseif($solicitud->estado == 2)
                                    <td>Aceptado</td>
                                    @else
                                    <td>Rechazado</td>
                                    @endif
                                </tr> 

                                @endif
                                @endcan
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @can('users.index')
                    <div class="modal-footer text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                    @endcan
                </div>
            </div>
        @can('users.index')
        </div>
        @endcan
        
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