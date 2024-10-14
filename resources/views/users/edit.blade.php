@extends('adminlte::page')

@section('title', 'Roles')

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

            @livewire('user.edit', ['id_user' => $user->id])
            
            @can('users.delete')

            <h5>Listado de Roles</h5>

            {!! Form::model($user, ['route' => ['users.update', $user], 'method' => 'put']) !!}

                @foreach ($roles as $role)
                    @can('super-admin')
                        @if ($role->name == 'Super-Admin')
                        <div class="">
                            <label for="">
                                {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                                {{ $role->name }}
                            </label>
                        </div>
                        @endif
                    @endcan 

                    @if ($role->name != 'Super-Admin')
                    <div class="">
                        <label for="">
                            {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                            {{ $role->name }}
                        </label>
                    </div>
                    @endif
                @endforeach
                
                {!! Form::submit('Asignar Rol', ['class' => 'btn btn-primary mt-2']) !!}
                
            {!! Form::close() !!}

            @endcan
        </div>
    </div>
@stop

@livewireScripts