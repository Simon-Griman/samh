@extends('adminlte::page')

@section('title', 'Equipos')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="card mt-2">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <th>Equipo</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Serial</th>
                            <th>Bien Nacional</th>
                            <th>Rol Equipo</th>
                            <th>Usuario</th>
                        </thead>
                        <tbody>
                            @foreach ($equipos as $equipo)
                            <td>{{ $equipo->equipo }}</td>
                            <td>{{ $equipo->marca }}</td>
                            <td>{{ $equipo->modelo }}</td>
                            <td>{{ $equipo->serial }}</td>
                            <td>{{ $equipo->bien_nacional }}</td>
                            <td>{{ $equipo->rol }}</td>
                            <td>{{ $equipo->name }}</td>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop