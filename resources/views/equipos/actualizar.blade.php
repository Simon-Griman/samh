@extends('adminlte::page')

@section('title', 'Equipos')

@livewireStyles

@section('content')
    @livewire('equipo.edit', ['equipo' => $equipo])
    
@stop

@livewireScripts