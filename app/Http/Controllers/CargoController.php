<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function __invoke()
    {
        return view('cargos.index');
    }
}
