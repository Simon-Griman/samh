@extends('adminlte::page')

@section('title', 'Usuarios')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@section('content')
    @livewireStyles
    @if (session('info'))
    @section('js')
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

    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">
    <br><br>
    @livewire('user.index')
    @livewireScripts
@stop