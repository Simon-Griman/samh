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
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="card mt-2">
                <div class="card-body">

                    <h2>{{ $user->name }}</h2>

                    <table class="table table-responsive table-hover">
                        <thead>
                            <tr>
                                <th>Equipo</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Serial</th>
                                <th>Bien Nacional</th>
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
        </div>
    </div>
</body>
</html>