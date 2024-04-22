@extends('adminlte::page')

@section('title', 'Bienes')

@livewireStyles

@section('content')
    @livewire('equipo.show', ['equipo' => $equipo])
    
@stop

@livewireScripts