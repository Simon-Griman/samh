<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2">
            <div class="card-body">
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Equipo</th>
                            <th>Usuario</th>
                            <th>Solicitante</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($solicitudes as $solicitud)
                        <tr>
                            <td>{{ $solicitud->equipo }}</td>

                            @foreach($destinatario as $destino)
                                @if($destino->id == $solicitud->id)
                                <td>{{ $destino->destinatario }}</td>
                                @endif
                            @endforeach

                            <td>{{ $solicitud->user }}</td>
                            <td><button class="btn btn-success" data-toggle="modal" data-target="#solicitar" wire:click="equipo({{ $solicitud->id }})">Aceptar</button></td>
                        </tr>    
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>