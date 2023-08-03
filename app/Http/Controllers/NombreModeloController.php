<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NombreModeloController extends Controller
{
    public function index()
    {
        return view('nombre-modelos.index');
    }
}
