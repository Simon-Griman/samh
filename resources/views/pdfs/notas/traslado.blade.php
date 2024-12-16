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
            <h5 class="span-title">Traslado de Equipo</h5>
            <table class="table table-responsive table-hover tabla mb-4">
                <tr>
                    <td class="text-center" style="width: 34%">Resposable</td>
                    <td class="text-center" style="width: 33%">Firma</td>
                    <td class="text-center" style="width: 33%">Descripción del Traslado</td>
                </tr>
                <tr>
                    <td class="text-center">Nombre y Apellido: <br>{{ $user->name }} <br>C.I. {{ $user->cedula }}</td>
                    <td></td>
                    <td><strong>Origen:</strong> {{ $origen }} <br><strong>Destino:</strong> {{ $destino }}</td>
                </tr>
                <tr>
                    <td class="text-center">@if ($cargo) {{ $cargo->nombre }} @endif</td>
                    <td></td>
                    <td><strong>Fecha:</strong> {{ $fecha }}</td>
                </tr>
            </table>

            <table class="table table-responsive table-hover tabla">
                <thead>
                    <tr>
                        <th class="text-center">Renglón</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Unidad</th>
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Propiedad</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipos as $equipo)
                        <tr>
                            <td class="text-center">{{ $renglon++ }}</td>
                            <td class="text-center">1</td>
                            <td class="text-center">Unidad</td>
                            <td>
                                Nombre: {{ $equipo['nombre'] }} <br>
                                Marca: {{ $equipo['marca'] }} <br>
                                Modelo: {{ $equipo['modelo'] }} <br>
                                Serial: {{ $equipo['serial'] }} <br>
                                Bien Nacional: {{ $equipo['bien_nacional'] }} <br>
                            </td>
                            <td class="text-center">SAMH</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <br><br><br><br>

            <h5 class="span-title">Autorización Entrada - Salida</h5>
            <table class="table table-responsive table-hover tabla">
                <thead>
                    <tr>
                        <th colspan="2" >DIRECTORA DE OSTI DEL SAMH</th>
                        <th colspan="2" >JEFE DE DIVICIÓN DE ADMINISTRACIÓN Y SERVICIOS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2" >Nombre: Jessica Salas</td>
                        <td colspan="2">Nombre: </td>
                    </tr>
                    <tr>
                        <td colspan="2">Cedula: 18.307.632</td>
                        <td colspan="2">Cedula: </td>
                    </tr>
                    <tr>
                        <td style="width: 25%">Firma:</td>
                        <td style="width: 25%"></td>
                        <td style="width: 25%">Firma:</td>
                        <td style="width: 25%">Fecha: {{ $fecha }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">PROTECCIÓN INTEGRAL DRM</td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Nombre y Cedula:</td>
                        <td colspan="2"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>