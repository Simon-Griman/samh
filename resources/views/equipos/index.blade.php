@extends('adminlte::page')

@section('title', 'Bienes')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@section('content')
    @livewireStyles

    @if (session('crear'))
        @section('js')
            <script src="{{ url('js/sweetalert2.js') }}"></script>
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
            <script src="{{ url('js/sweetalert2.js') }}"></script>
            <script>
                Swal.fire(
                    "¡Hecho!",
                    "{{ session('actualizar') }}",
                    "success"
                )
            </script>
        @stop
    @endif

    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">
    
    @can('equipos.create')
    <div class="text-center">
        <a href="{{ route('equipos.create') }}" class="btn btn-success mt-2">Nuevo Bien Nacional</a>
    </div>
    @endcan

    @livewire('equipo.index')
    @livewireScripts
@stop

