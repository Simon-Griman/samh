@extends('adminlte::page')

@section('title', 'Inicio')

@livewireStyles

@section('content')
    <br>
    @can('nuevo_usuario')
        @livewire('nuevo-usuario.index')
    @endcan
@stop

@livewireScripts