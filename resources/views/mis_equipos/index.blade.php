@extends('adminlte::page')

@section('title', 'Mis Equipos')



@section('content')
    @livewireStyles

    <img src="{{ url('storage/' . $cintillo) }}" alt="" class="cintillo" style="width:100%">

    <div class="text-center pt-2">
        <a href="{{ route('mis_equipos.pdf') }}" class="btn btn-danger"><i class="fas fa-file-pdf"></i>&nbsp;Exportar</a>
    </div>

    @livewire('mi-equipo.index')
    @livewireScripts
@stop

