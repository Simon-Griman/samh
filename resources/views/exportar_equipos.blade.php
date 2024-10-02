@extends('adminlte::page')

@section('title', 'Exportar Registros')

@livewireStyles

@section('content')
    <img src="{{ url('storage/profile-photos/cintillo_osti.jpg') }}" alt="" class="cintillo" style="width:100%">
    <br>
    @livewire('exportar-equipo', ['users' => $users, 'departamentos' => $departamentos, 'ubicaciones' => $ubicaciones, 'roles' => $roles])
@stop

@livewireScripts