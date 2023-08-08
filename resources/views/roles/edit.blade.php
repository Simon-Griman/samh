@extends('adminlte::page')

@section('title', 'Roles')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@livewireStyles

@section('content')
    <br>
    <button class="btn btn-danger mb-4"><a class="text-light" href="{{ route('roles.index') }}"><i class="fas fa-caret-left"></i> Volver</a></button>
    <div class="card">
        <div class="card-body">

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

            Command: toastr["success"]("{{ session('info') }}", "Hecho");
        </script>
        @stop
        @endif

            {!! Form::model($rol, ['route' => ['roles.update', $rol], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre', ['class' => 'h5 font-weight-normal']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Nombre del Rol']) !!}

                    
                </div>

                <h3>Lista de Permisos</h3>

                @foreach ($permisos as $permiso)
                    <div>
                        <label>
                        {!! Form::checkbox('permissions[]', $permiso->id, null, ['class' => 'mr-1']) !!}
                        {{ $permiso->name }}
                        </label>
                    </div>
                @endforeach

                {!! Form::submit('Editar Rol', ['class' => 'btn btn-primary mt-2']) !!}

            {!! Form::close() !!}

        </div>
    </div>
@stop

@livewireScripts