@extends('adminlte::page')

@section('title', 'Equipos')

@section('content')
    @livewire('equipo.index', ['equipos' => $equipos])
@stop