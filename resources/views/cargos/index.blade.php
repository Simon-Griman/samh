@extends('adminlte::page')

@section('title', 'Cargos')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop

@section('content')
    @livewireStyles
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">

    @livewire('cargo.index')
    @livewireScripts
@stop