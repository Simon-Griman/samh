<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card mt-2">
            <div class="card-body">
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