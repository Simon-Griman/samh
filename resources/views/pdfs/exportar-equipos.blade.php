<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Registro de Bienes Nacionales</title>
    <style>
        <?php include(public_path().'/css/app.css');?>
        <?php include(public_path().'/css/estilos.css');?>
    </style>
</head>
<body>

    <?php 
        $imagen = 'storage/profile-photos/cintillo_osti.jpg';
        $base64 = base64_encode(file_get_contents($imagen));
    ?>

    <header>
        <img src="data:image/png;base64,<?php echo $base64 ?>" class="w-100">
        <div class="text-center m-4">
            <h3>Registro de Bienes Nacionales</h3>
        </div>
    </header>

    <div class="card content">
        <div class="card-body">

            <table class="table table-responsive table-hover tabla">
                <thead>
                    <tr>
                        <th class="gris">Nombre</th>
                        <th class="gris">Marca</th>
                        <th class="gris">Modelo</th>
                        <th class="gris">Serial</th>
                        <th class="gris">Bien Nacional</th>
                        <th class="gris">Estado</th>
                        
                        <th class="gris">Departamento</th>
                        <th class="gris">Usuario</th>
                        <th class="gris">Ubicación</th>
                        <th class="gris">Proveedor</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($equipos as $equipo)
                    <tr>
                        <td>{{ $equipo->equipo }}</td>
                        <td>{{ $equipo->marca }}</td>
                        <td>{{ $equipo->modelo }}</td>
                        <td>{{ $equipo->serial }}</td>
                        @if ($equipo->bien_nacional == 0)
                        <td></td>
                        @elseif ($equipo->bien_nacional >= 1000)
                        <td>0000{{ $equipo->bien_nacional }}</td>
                        @else
                        <td>00000{{ $equipo->bien_nacional }}</td>
                        @endif
                        <td>{{ $equipo->rol }}</td>
                        <td>{{ $equipo->departamento }}</td>
                        <td>{{ $equipo->name }}</td>
                        <td>{{ $equipo->ubicacion }}</td>
                        <td>{{ $equipo->proveedor }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>