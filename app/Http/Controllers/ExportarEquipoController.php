<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Equipo;
use App\Models\Rolequipo;
use App\Models\Ubicacion;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportarEquipoController extends Controller
{
    public function index()
    {
        $users = User::all();
        $departamentos = Departamento::all();
        $ubicaciones = Ubicacion::all();
        $roles = Rolequipo::all();

        return view('exportar_equipos', compact('users', 'departamentos', 'ubicaciones', 'roles'));
    }

    public function downloadEquipos($user_id = 0, $departamento_id = 0, $ubicacion_id = 0, $f_adquisicion = null, $rol_id = 0)
    {
        $equipos = Equipo::select('equipos.id', 'tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'modelos.id as id_modelo', 'modelos.nombre as modelo', 'serial', 'bien_nacional', 'rolequipos.id as id_rol', 'rol', 'departamentos.id as id_departamento', 'departamentos.nombre as departamento', 'users.id as id_user', 'name', 'observacion', 'creado', 'actualizado', 'ubicacions.nombre as ubicacion', 'fecha_adquisicion', 'depreciacion', 'proveedors.nombre as proveedor')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
            ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
            ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
            ->leftjoin('departamentos', 'departamentos.id', '=', 'equipos.departamento_id')
            ->leftjoin('users', 'users.id', '=', 'equipos.user_id')
            ->leftjoin('ubicacions', 'ubicacions.id', '=', 'users.ubicacion_id')
            ->leftjoin('proveedors', 'proveedors.id', '=', 'equipos.proveedor_id')
        ;

        if ($user_id != 0)
        {
            $equipos->where('user_id', $user_id);
        }

        if ($departamento_id != 0)
        {
            $equipos->where('equipos.departamento_id', $departamento_id);
        }

        if ($ubicacion_id != 0)
        {
            $equipos->where('ubicacion_id', $ubicacion_id);
        }

        if ($f_adquisicion != 0)
        {
            $equipos->where('fecha_adquisicion', $f_adquisicion);
        }

        if ($rol_id != 0)
        {
            $equipos->where('rolequipo_id', $rol_id);
        }

        $pdf = Pdf::loadView('pdfs.exportar-equipos', ['equipos' => $equipos->get()])->setPaper('a4', 'landscape');

        return $pdf->download('exportar-registros.pdf');
    }
}