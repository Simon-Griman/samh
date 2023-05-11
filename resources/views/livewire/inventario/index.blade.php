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
                    @foreach ($equipos as $equipo)
                        <tr>
                            <td>{{ $equipo->equipo }}</td>
                            <td>{{ $equipo->marca }}</td>
                            <td>{{ $equipo->modelo }}</td>
                            <td>{{ $equipo->serial }}</td>
                            <td>{{ $equipo->bien_nacional }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>