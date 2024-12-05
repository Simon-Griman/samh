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
        $imagen = 'storage/' . $cintillo;
        $base64 = base64_encode(file_get_contents($imagen));
    ?>

    <header>
        <img src="data:image/png;base64,<?php echo $base64 ?>" class="w-100">
    </header>

    <div class="card content">
        <div class="card-body">

            <table class="table table-responsive table-hover tabla">
                <thead>
                    <tr>
                        <th colspan="3" class="text-center" style="border-bottom: 0">NOTA DE ENTREGA</th>
                    </tr>
                    <tr>
                        <th class="border border1">Fecha: {{ $fecha }}</th>
                        <th class="border border2"></th>
                        <th class="border border3 text-center">N° de Nota: OSTI - @if ($nro < 10) 00{{ $nro }} @elseif ($nro < 100) 0{{ $nro }} @else {{ $nro }} @endif </th>
                    </tr>
                    <tr>
                        <th colspan="3" style="border-bottom: 0">PARA: {{ $user->name }} - @if ($cargo) {{ $cargo->nombre }} @endif</th>
                    </tr>
                    <tr>
                        <th colspan="3" style="border-top: 0" >DE: Jessica Salas - Directora de OSTI</th>
                    </tr>
                    <tr>
                        <th colspan="3"></th>
                    </tr>
                    <tr>
                        <th class="sub-title text-center">CANTIDAD</th>
                        <th class="sub-title text-center">UNIDAD</th>
                        <th class="sub-title text-center">DESCRIPCIÓN</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bienes as $bien)
                    <tr>
                        <td class="content">1</td>
                        <td class="column2 content">UNIDAD</td>
                        <td class="column">
                            @foreach ($equipos as $equipo)
                                @if ($bien == $equipo['id_tipo'])
                                    Nombre: {{ $equipo['nombre'] }} <br>
                                    Marca: {{ $equipo['marca'] }} <br>
                                    Modelo: {{ $equipo['modelo'] }} <br>
                                    Serial: {{ $equipo['serial'] }} <br>
                                    Bien Nacional: {{ $equipo['bien_nacional'] }} <br>
                                @endif
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">OBSERVACIONES: <br> {{ $observacion }}</td>
                    </tr>
                    <tr>
                        <td>
                            <p>Firma:</p>
                            <p class="text-center">Jessica Salas</p>
                            <p class="text-center">C.I. 18307632</p>
                            <br>
                            <small class="text-center">Directora de la Oficina de Sistemas y Tecnología de la Información OSTI</small>
                        </td>
                        <td></td>
                        <td class="subtabla">
                            <table class="tabla2">
                                <tr>
                                    <td style="text-align: left">Firma:</td>
                                    <td>Sello:</td>
                                </tr>
                                <br><br><br><br><br>
                                <tr>
                                    <td style="text-align: left">Recibido por:</td>
                                    <td>{{ $user->name }} - @if ($cargo) {{ $cargo->nombre }} @endif</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>V-{{ $user->cedula }}</td>
                                </tr>
                            </table>

                            {{--<span class="firma">Firma: </span><span style="font-size: 14px">Sello:</span><br><br><br><br><br><br>
                            <small class="firma">RECIBIDO POR: </small><small>{{ $user->name }} - @if ($cargo) {{ $cargo->nombre }} @endif</small><br>
                            <div class="firma"></div><small class="text-center">V-{{ $user->cedula }}</small>--}}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</body>
</html>