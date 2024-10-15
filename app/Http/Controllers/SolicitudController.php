<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    public function solicitar()
    {
        return view('solicitud.solicitar');
    }

    public function solicitudes()
    {
        return view('solicitud.solicitudes');
    }

    public function misSolicitudes()
    {
        return view('solicitud.estatus_solicitudes');
    }
}
