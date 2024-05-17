<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticuloController extends Controller
{
    public function __invoke()
    {
        return view('articulos.index');
    }
}
