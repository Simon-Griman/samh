@extends('adminlte::page')

@section('title', 'Roles y Permisos')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@livewireStyles

@section('content')
    @if (session('info'))
    @section('js')
        <script src="{{ url('js/jquery.js') }}"></script>
        <script src="{{ url('js/toastr.js') }}"></script>
        <script>
            toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            }

            Command: toastr["info"]("{{ session('info') }}", "Hecho");
        </script>
    @stop
    @endif
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">
    <br><br>
    <div class="card">
        <div class="card-body">
            <a href="{{ route('roles.create') }}" class="btn btn-success float-right mb-2" >Crear Rol</a>
            <table class="table table-striped">
                <thead class="bg-gray">
                    <tr>
                        <th>ID</th>
                        <th>Rol</th>
                        <th colspan="2" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td width="10px" style="padding: 0 5px; ">
                            <a href="{{ route('roles.edit', $role) }}" class="btn btn-sm btn-primary mt-2">Editar</a>
                        </td>
                        <td width="10px" style="padding: 0 5px; ">
                            <form action="{{ route('roles.destroy', $role) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger mt-2">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@livewireScripts