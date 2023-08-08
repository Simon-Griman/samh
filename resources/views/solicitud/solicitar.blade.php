@extends('adminlte::page')

@section('title', 'Solicitar')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@livewireStyles

@section('content')
    
    @livewire('solicitud.solicitar')
@stop

@livewireScripts