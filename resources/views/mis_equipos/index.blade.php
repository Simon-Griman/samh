@extends('adminlte::page')

@section('title', 'Mis Equipos')

@livewireStyles

@section('content')

    <img src="{{ url('storage/profile-photos/cintillo_osti.jpg') }}" alt="" class="cintillo" style="width:100%">

    <div class="text-center pt-2">
        <a href="{{ route('mis_equipos.pdf') }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i>&nbsp;Exportar</a>
    </div>

    @livewire('mi-equipo.index')

@stop

@livewireScripts