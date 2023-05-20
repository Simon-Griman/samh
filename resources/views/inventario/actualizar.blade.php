@extends('adminlte::page')

@section('title', 'Inventario')

@livewireStyles

@section('content')
    @livewire('inventario.edit', ['equipo' => $equipo])
@stop

@livewireScripts