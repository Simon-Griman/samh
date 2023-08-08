@extends('adminlte::page')

@section('title', 'Solicitudes')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@livewireStyles

@section('content')
    @livewire('solicitud.solicitudes')
@stop

@livewireScripts