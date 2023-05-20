@extends('adminlte::page')

@section('title', 'Inventario')

@livewireStyles

@section('content')

    @can('inventario.create')
    <div class="text-center">
        <a href="{{ route('equipos.create') }}" class="btn btn-success mt-2">Nuevo Equipo</a>
    </div>
    @endcan

    @livewire('inventario.index')
@stop

@livewireScripts