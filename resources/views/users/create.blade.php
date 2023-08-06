@extends('adminlte::page')

@section('title', 'Usuarios')

@livewireStyles

@section('content')
    <br>
    @livewire('user.create')
@stop

@livewireScripts