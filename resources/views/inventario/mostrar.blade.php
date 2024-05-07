@extends('adminlte::page')

@section('title', 'Inventario')

@livewireStyles

@section('content')
    @livewire('inventario.show', ['equipo' => $equipo])
@stop

@livewireScripts