@extends('adminlte::page')

@section('title', 'Inicio')

@section('content')
    @livewireStyles
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">
    <br><br>
    @can('nuevo_usuario')
        @livewire('nuevo-usuario.index')
    @endcan

    @can('mis_equipos')
    <div class="text-center">
        <img src="{{ url('vendor/adminlte/dist/img/LOGO_SAMH.jpg') }}" alt="logo samh" class="w-75">
    </div>
    @endcan
    @livewireScripts
@stop