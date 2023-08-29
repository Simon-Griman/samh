<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Mis Equipos</title>
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

    <div class="container">
        <div class="row d-flex justify-content-center">
            <img src="data:image/png;base64,<?php echo $base64 ?>" class="w-100">
            <div class="text-center m-4">
                <h3>Control de Inventario por Ubicación y Usuario</h3>
            </div>
            <div class="card mt-2">
                <div class="card-body">

                    <table class="table table-responsive table-hover tabla">
                        <thead>
                            <tr>
                                <th class="gris">Usuario</th>
                                <th>{{ $user->name }}</th>
                                <th>C.I. {{ $user->cedula }}</th>
                                <th class="gris">Ubicación</th>
                                <th>{{ $departamento }}</th>
                            </tr>
                            <tr>
                                <th class="gris">Nombre</th>
                                <th class="gris">Marca</th>
                                <th class="gris">Modelo</th>
                                <th class="gris">Serial</th>
                                <th class="gris">Bien Nacional</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($misEquipos as $miEquipo)
                            <tr>
                                <td>{{ $miEquipo->equipo }}</td>
                                <td>{{ $miEquipo->marca }}</td>
                                <td>{{ $miEquipo->modelo }}</td>
                                <td>{{ $miEquipo->serial }}</td>
                                <td>{{ $miEquipo->bien_nacional }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br><br><br>
            <table class="table" id="linea">
                <tr>
                    <td class="yes text-center">Area de Bienes Nacionales</td>
                    <td class="none"></td>
                    <td class="yes text-center"> Firma del Usuario</td>
                </tr>
            </table>
            <br>
            <small><b>NOTA:</b> EL FUNCIONARIO ES RESPONSABLE DEL CUIDADO Y RESGUARDO DE LOS BIENES NACIONALES AQUI SEÑALADOS</small>
        </div>
    </div>
</body>
</html>