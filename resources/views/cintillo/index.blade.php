@extends('adminlte::page')

@section('title', 'Cintillos')

@section('css')
    <link rel="stylesheet" href="{{ url('css/toastr.css') }}">
@stop



@section('content')
    @livewireStyles
    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">

    @livewire('cintillo.index')
    @livewireScripts
@stop