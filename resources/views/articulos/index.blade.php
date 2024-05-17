@extends('adminlte::page')

@section('title', 'Articulos')

@livewireStyles

@section('content')
    @livewire('articulo.index')
@stop

@livewireScripts