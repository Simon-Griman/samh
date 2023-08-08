@extends('adminlte::page')

@section('title', 'Roles')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@livewireStyles

@section('content')
    <br>

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

    <button class="btn btn-danger mb-4"><a class="text-light" href="{{ route('roles.index') }}"><i class="fas fa-caret-left"></i> Volver</a></button>
    <div class="card">
        <div class="card-body">

            {!! Form::open(['route' => 'roles.store']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingresa el Nombre del Rol']) !!}

                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
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

                {!! Form::submit('Crear Rol', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>
    </div>
@stop

@livewireScripts