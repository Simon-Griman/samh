@extends('adminlte::page')

@section('title', 'Equipos')

@section('content')

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

    @livewire('equipo.index', ['equipos' => $equipos])
@stop