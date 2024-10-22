@extends('adminlte::page')

@section('title', 'Almacen')



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

    <div class="text-center">
        <a href="{{ route('almacen.create') }}" class="btn btn-success mt-2">Nuevo Articulo</a>
    </div>

    @livewire('almacen.index')

    @livewireScripts
@stop

