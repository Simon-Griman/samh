@extends('adminlte::page')

@section('title', 'Articulos')

@section('content')
    @livewireStyles
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">

    @livewire('articulo.index')
    @livewireScripts
@stop

