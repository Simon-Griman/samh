<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolEquipoController extends Controller
{
    public function index()
    {
        return view('rol-equipos.index');
    }
}
