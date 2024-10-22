@extends('adminlte::page')

@section('title', 'Nombre Equipos')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@livewireStyles

@section('content')

    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">

    @livewire('nombre-modelo.index')

@stop

@livewireScripts