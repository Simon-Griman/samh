@extends('adminlte::page')

@section('title', 'Inicio')

@livewireStyles

@section('content')
    <img src="{{ url('storage/profile-photos/cintillo_osti.jpg') }}" alt="" class="cintillo" style="width:100%">
    <br><br>
    @can('nuevo_usuario')
        @livewire('nuevo-usuario.index')
    @endcan
@stop

@livewireScripts