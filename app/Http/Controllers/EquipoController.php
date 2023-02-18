<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipoController extends Controller
{
    public function index(){
        
        $equipos = Equipo::select('tipoequipos.nombre as equipo', 'marcas.nombre as marca', 'modelos.nombre as modelo', 'serial', 'bien_nacional', 'rol', 'name')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
            ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
            ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
            ->join('users', 'users.id', '=', 'equipos.user_id')
            ->get()
        ;

        return view('equipos.index', compact('equipos'));
    }
}
