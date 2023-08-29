@extends('adminlte::page')

@section('title', 'Bienes')

@livewireStyles

@section('content')
    @livewire('equipo.edit', ['equipo' => $equipo])
    
@stop

@livewireScripts