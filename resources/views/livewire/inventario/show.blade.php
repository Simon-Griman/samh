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
                        <td>{{ $datos->bien_pdvsa }}</td>
                    </tr>
                    <tr>
                        <td>Bien Nacional Menpet</td>
                        <td>{{ $datos->bien_menpet }}</td>
                    </tr>
                    <tr>
                        <td>Estado del Equipo:</td>
                        <td>{{ $datos->rol }}</td>
                    </tr>
                    <tr>
                        <td>Observaciones:</td>
                        <td>{{ $datos->observacion }}</td>
                    </tr>
                    @can('user-index')
                    <tr>
                        <td>Creado por:</td>
                        <td>{{ $datos->creado }} <br> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($datos->f_creado))->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Actualizado por:</td>
                        <td>{{ $datos->actualizado }} <br> @if($datos->actualizado){{ \Carbon\Carbon::createFromTimeStamp(strtotime($datos->f_actualizado))->format('d-m-Y') }}@endif</td>
                    </tr>
                    @endcan
                </table>
            </div>
        </div>
        <div class="text-center col-12">
            <a href="{{ route('inventario.edit', $equipo->id) }}" class="btn btn-primary" title="editar">Actualizar</a>
            <a href="{{ route('inventario.index') }}" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>