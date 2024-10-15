<div class="container">
    <div class="row d-flex justify-content-center">
        <h3 class="text-center mt-2 col-12">Mis Solicitudes</h3>
        <div class="card mt-2" style="max-height: 70vh;">
            <div class="card-body overflow-auto">
                <table class="table table-responsive table-hover">
                    <thead>
                        <th>Bien Solicitado</th>
                        <th>Usuario</th>
                        <th>Estatus</th>
                    </thead>
                    <tbody>
                    @foreach($misSolicitudes as $miSolicitud)
                        <tr class="@if($miSolicitud->estado == 2) bg-success @elseif($miSolicitud->estado == 3) bg-danger @elseif($miSolicitud->estado == 1) bg-secondary @endif">
                            <td>{{ $miSolicitud->equipo }}</td>
                            <td>{{ $miSolicitud->destinatario }}</td>
                            @if ($miSolicitud->estado == 1)
                            <td>En Prceso</td>
                            @elseif ($miSolicitud->estado == 2)
                            <td>Aceptado</td>
                            @elseif ($miSolicitud->estado == 3)
                            <td>Rechazado</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
