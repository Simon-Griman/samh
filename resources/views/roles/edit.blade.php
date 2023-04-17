@extends('adminlte::page')

@section('title', 'Roles')

@livewireStyles

@section('content')
    <br>
    <button class="btn btn-danger mb-4"><a class="text-light" href="{{ route('roles.index') }}"><i class="fas fa-caret-left"></i> Volver</a></button>
    <div class="card">
        <div class="card-body">

        @if (session('info'))
        @section('js')
        <script>
            toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
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