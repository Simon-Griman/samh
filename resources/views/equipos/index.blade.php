@extends('adminlte::page')

@section('title', 'Equipos')

@livewireStyles

@section('content')

    @if (session('crear'))
        @section('js')
            <script>
                Swal.fire(
                    "¡Hecho!",
                    "{{ session('crear') }}",
                    "success"
                )
            </script>
        @stop
    @endif

    @if (session('actualizar'))
        @section('js')
            <script>
                Swal.fire(
                    "¡Hecho!",
                    "{{ session('actualizar') }}",
                    "success"
                )
            </script>
        @stop
    @endif
    
    @can('equipos.create')
    <div class="text-center">
        <a href="{{ route('equipos.create') }}" class="btn btn-success mt-2">Nuevo Equipo</a>
    </div>
    @endcan

    @livewire('equipo.index')
@stop

@livewireScripts