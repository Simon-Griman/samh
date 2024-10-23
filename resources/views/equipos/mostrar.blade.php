@extends('adminlte::page')

@section('title', 'Bienes')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@livewireStyles

@section('content')
    @livewire('equipo.show', ['equipo' => $equipo])
    
@stop

@livewireScripts