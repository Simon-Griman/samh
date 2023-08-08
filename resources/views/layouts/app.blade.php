<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

       <!-- Favicon -->
       <!--<link rel="shortcut icon" href="{{ url ('favicons/favicon.ico') }}" type="image/x-icon">-->

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet"> -->

        <!-- Styles -->
        

        @livewireStyles

        <!-- Scripts -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    
            @extends('adminlte::page')
            @section('content')
            {{ $slot }}

            @stop

        @stack('modals')

        @livewireScripts

        @stack('scripts')
    
</html>
