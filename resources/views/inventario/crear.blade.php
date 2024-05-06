@extends('adminlte::page')

@section('title', 'Inventario')

<link rel="stylesheet" href="{{ url('css/select2.css') }}">

@section('js')
    <script src="{{ url('js/select2.js') }}"></script>
@stop

@livewireStyles

@section('content')
    @livewire('inventario.create')
@stop

@livewireScripts