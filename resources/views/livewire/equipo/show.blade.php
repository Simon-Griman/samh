<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2 col col-lg-9 mx-auto">
            <div class="card-body pb-0 w-100">            
                <table class="table">
                    <tr>
                        <td>Nombre:</td>
                        <td>{{ $equipos }}</td>
                    </tr>
                    <tr>
                        <td>Marca:</td>
                        <td>{{ $marcas }}</td>
                    </tr>
                    <tr>
                        <td>Modelo:</td>
                        <td>{{ $modelos }}</td>
                    </tr>
                    <tr>
                        <td>Serial:</td>
                        <td>{{ $serial }}</td>
                    </tr>
                    <tr>
                        <td>Bien Nacional:</td>
                        <td>{{ $bien_nacional }}</td>
                    </tr>
                    <tr>
                        <td>Estado del Equipo:</td>
                        <td>{{ $roles }}</td>
                    </tr>
                    <tr>
                        <td>Departamento:</td>
                        <td>{{ $departamentos }}</td>
                    </tr>
                    <tr>
                        <td>Usuario</td>
                        <td>{{ $usuarios }}</td>
                    </tr>
                    <tr>
                        <td>Observaciones:</td>
                        <td>{{ $observacion }}</td>
                    </tr>
                    <tr>
                        <td>Ubicaión:</td>
                        <td>{{ $equipo->ubicacion }}</td>
                    </tr>
                    <tr>
                        <td>Creado por:</td>
                        <td>{{ $creado }}</td>
                    </tr>
                    <tr>
                        <td>Actualizado por:</td>
                        <td>{{ $equipo->actualizado }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="text-center col-12">
            <a href="{{ route('equipos.edit', $equipo->id) }}" class="btn btn-primary" title="editar">Actualizar</a>
            <a href="{{ route('equipos.index') }}" class="btn btn-danger">Volver</a>
        </div>
    </div>
</div>
