@extends('adminlte::page')

@section('title', 'Almacen')

@livewireStyles

<link rel="stylesheet" href="{{ url('css/select2.css') }}">

@section('js')
    <script src="{{ url('js/select2.js') }}"></script>
@stop

@section('content')
    @livewire('almacen.create')
@stop

@livewireScripts