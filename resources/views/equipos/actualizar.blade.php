@extends('adminlte::page')

@section('title', 'Equipos')

@section('content')
    @livewire('equipo.edit', ['equipo' => $equipo])
@stop