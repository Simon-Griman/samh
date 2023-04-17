@extends('adminlte::page')

@section('title', 'Roles')

@livewireStyles

@section('content')
    
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

    <br>

    <button class="btn btn-danger mb-4"><a class="text-light" href="{{ route('users.index') }}"><i class="fas fa-caret-left"></i> Volver</a></button>

    <div class="card">
        <div class="card-body">
            <h5>Nombre</h5>
            <p class="form-control">{{ $user->name }}</p>

            <h5>Listado de Roles</h5>

            {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'put']) !!}

                @foreach ($roles as $role)

                    <div class="">
                        <label for="">
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                            {{ $role->name }}
                        </label>
                    </div>
                    
                @endforeach
                
                {!! Form::submit('Asignar Rol', ['class' => 'btn btn-primary mt-2']) !!}
                
            {!! Form::close() !!}
        </div>
    </div>
@stop

@livewireScripts