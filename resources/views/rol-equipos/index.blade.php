@extends('adminlte::page')

@section('title', 'Nombre Equipos')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@livewireStyles

@section('content')

    @livewire('rol-equipo.index')

@stop

@livewireScripts