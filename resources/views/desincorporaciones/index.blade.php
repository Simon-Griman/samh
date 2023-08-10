@extends('adminlte::page')

@section('title', 'Equipos')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@livewireStyles

@section('content')
    <br>
    @livewire('desincorporacion.index')
@stop

@livewireScripts