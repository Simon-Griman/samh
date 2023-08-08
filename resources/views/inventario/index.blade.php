@extends('adminlte::page')

@section('title', 'Inventario')

@livewireStyles

@section('content')

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

    <div class="text-center">
        <a href="{{ route('inventario.create') }}" class="btn btn-success mt-2">Nuevo Equipo</a>
    </div>

    @livewire('inventario.index')
@stop

@livewireScripts