<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NombreMarcaController extends Controller
{
    public function index()
    {
        return view('nombre-marcas.index');
    }
}
