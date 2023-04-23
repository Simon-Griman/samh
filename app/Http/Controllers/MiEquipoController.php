<?php

namespace App\Http\Controllers;

use App\Models\Equipo;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MiEquipoController extends Controller
{
    public function index()
    {
        return view('mis_equipos.index');
    }

    public function downloadEquipos()
    {
        $user = Auth::User()->id;

        $misEquipos = Equipo::select('equipos.id', 'tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'modelos.id as id_modelo', 'modelos.nombre as modelo', 'serial', 'bien_nacional', 'rolequipos.id as id_rol', 'rol', 'departamentos.id as id_departamento', 'departamentos.nombre as departamento', 'users.id as id_user', 'name')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
            ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
            ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
            ->join('departamentos', 'departamentos.id', '=', 'equipos.departamento_id')
            ->join('users', 'users.id', '=', 'equipos.user_id')
            ->where('user_id', $user)
            ->get()
        ;

        $pdf = Pdf::loadView('pdfs.mis-equipos', ['misEquipos' => $misEquipos])->setOptions(['defaultFont' => 'arial']);

        return $pdf->download('mis-equipos.pdf');
    }
}
