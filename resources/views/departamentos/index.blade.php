@extends('adminlte::page')

@section('title', 'Nombre Departamentos')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@livewireStyles

@section('content')

    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">

    @livewire('departamento.index')

@stop

@livewireScripts