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
                    <tr>
                        <td>Fecha de Adquisición:</td>
                        @if ($datos->fecha_adquisicion)
                        <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($datos->fecha_adquisicion))->format('d-m-Y') }}</td>
                        @else
                        <td></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Depreciación (Representada en Meses):</td>
                        <td>{{ $datos->depreciacion }}</td>
                    </tr>
                    <tr>
                        <td>Depreciación Acumulada (Representada en Meses):</td>
                        @if ($datos->depreciacion)
                        <td class="@if ($d_mensual >= $datos->depreciacion) text-danger @endif">{{ $d_mensual }}</td>
                        @else
                        <td></td>
                        @endif
                    </tr>
                    <tr>
                        <td>Proveedor:</td>
                        <td>{{ $datos->proveedor }}</td>
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

                    @if($perifericos)
                        @foreach ($dependientes as $dependiente)
                        <tr>
                            <td colspan="2" align="center"><strong>Periferico {{ $cont }}</strong></td>
                        </tr>
                        <tr>
                            <td>Nombre:</td>
                            <td>{{ $dependiente->nombre }}</td>
                        </tr>
                        <tr>
                            <td>Marca:</td>
                            <td>{{ $dependiente->marca }}</td>
                        </tr>
                        <tr>
                            <td>Modelo:</td>
                            <td>{{ $dependiente->modelo }}</td>
                        </tr>
                        <tr>
                            <td>Serial:</td>
                            <td>{{ $dependiente->serial }}</td>
                        </tr>

                        @php $cont++ @endphp
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
        <div class="text-center col-12">
            <a href="{{ route('inventario.edit', $equipo->id) }}" class="btn btn-primary" title="editar">Actualizar</a>
            <a href="{{ route('inventario.index') }}" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>