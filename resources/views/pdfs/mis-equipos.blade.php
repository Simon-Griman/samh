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
        $imagen = 'storage/profile-photos/cintillo_ayacucho.jpg';
        $base64 = base64_encode(file_get_contents($imagen));
    ?>
    <div class=""></div>
        <header>
            <img src="data:image/png;base64,<?php echo $base64 ?>" class="w-100">
        </header>

        <table class="tabla table table-responsive tabla1">
            <tr>
                <td colspan="3" class="text-center title"><strong>FICHA DE ASIGNACIÓN DE BIENES PÚBLICOS A RESPONSABLE DIRECTO Y FINAL DE USO</strong></td>
            </tr>
            <tr>
                <td><strong>ORGANISMO</strong></td>
                <td class="text-center"><strong>SERVICIO AUTONIOMO DE METROLOGIA DE HIDROCARBUROS</strong></td>
                <td>FECHA:</td>
            </tr>
            <tr>
                <td><strong>UNIDAD ADM. ESTRUCTURAL:</strong></td>
                <td class="text-center">{{ $departamento }}</td>
                <td class="gris">{{ $fecha }}</td>
            </tr>
            <tr>
                <td class="gris"><strong>RESPONSABLE ADMIN 1:</strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>CÉDULA DE IDENTIDAD:</strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>CARGO:</strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>UNIDAD ADM. FUNCIONAL:</strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td class="gris"><strong>RESPONSABLE ADMIN 2:</strong></td>
                <td>{{ $user->name }}</td>
                <td class="gris">ACTIVO: (X)</td>
            </tr>
            <tr>
                <td><strong>CÉDULA DE IDENTIDAD:</strong></td>
                <td>{{ $user->cedula }}</td>
                <td class="gris">PASIVO: ( )</td>
            </tr>
            <tr>
                <td><strong>CARGO:</strong></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td><strong>UBICACIÓN GEOGRÁFICA</strong></td>
                @if ($ubicacion == 'Maracaibo')
                <td class="gris text-center"><strong>Av.5 de Julio con calle 71 edificio  Minpet Maracaibo estado Zulia</strong></td>
                @else
                <td class="gris">{{ $ubicacion }}</td>
                @endif
                <td></td>
            </tr>
        </table>

        <div class="text-center">
            <p class="sub-title"><strong>DESCRIPCIÓN DEL BIEN</strong></p>
        </div>

        <div class="card">
            <div class="card-body">

                <table class="table table-responsive table-hover tabla tabla2">
                    <thead>
                        <tr>
                            <th>ÍTEM</th>
                            <th>N° DE BIEN PÚBLICO</th>
                            <th>DESCRIPCIÓN</th>
                            <th>MARCA</th>
                            <th>MODELO</th>
                            <th>SERIAL</th>
                            <th>ESTADO</th>
                            <th>FECHA DE ADQUISICIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($misEquipos as $miEquipo)
                        <tr>
                            <td>{{ $item++ }}</td>
                            @if ($miEquipo->bien_nacional >= 1000)
                            <td>0000{{ $miEquipo->bien_nacional }}</td>
                            @else
                            <td>00000{{ $miEquipo->bien_nacional }}</td>
                            @endif
                            <td>{{ $miEquipo->equipo }}</td>
                            <td>{{ $miEquipo->marca }}</td>
                            <td>{{ $miEquipo->modelo }}</td>
                            <td>{{ $miEquipo->serial }}</td>
                            <td>{{ $miEquipo->rol }}</td>
                            <td>{{ $miEquipo->fecha_adquisicion }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <p class="justy">Cabe destacar la importancia y deber de cada trabajador de mantener, conservar y proteger los bienes nacionales de conformidad con lo establecido en el decreto Nro. 1.407, con Rango Valor y Fuerza de Ley Orgánica de Bienes Públicos, de fecha 13 de noviembre del año 2014, publicado en Gaceta Oficial Extraordinaria Nro. 6.155 de fecha 19 de noviembre del año 2014. De igual forma se les recuerda que los responsables de los bienes nacionales deben velar por la conservación y buen uso de los mismos evitando así sanciones penales, civiles, administrativas y disciplinarias establecidas en la referida Ley</p>
        <br><br><br>
        <table class="table" id="linea">
            <tr>
                <td class="yes text-center">
                    <small class="responsable">RESPONSABLE FINAL DE USO</small>
                    <p class="nombre"><strong>{{ mb_strtoupper($user->name) }}</strong></p>
                    <p class="cedula"><strong>{{ $user->cedula }}</strong></p>
                </td>
                <td class="none"></td>
                <td class="yes text-center">
                    <small class="responsable">RESPONSABLE PATRIMONIAL SAMH</small>
                    <p class="nombre"><strong>DIANORAH VALERO</strong></p>
                    <p class="cedula"><strong>7965185</strong></p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>