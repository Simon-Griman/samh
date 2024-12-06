<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Equipo;
use App\Models\NroControl;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class NotaSalidaController extends Controller
{
    public function index()
    {
        return view('notas.salida');
    }

    public function downloadEquipos($selecciones, $usuario, $observacion = '')
    {
        $bienes = json_decode($selecciones, true);

        $user = User::find($usuario);

        $equipos = [];
        
        foreach ($bienes as $bien)
        {
            $resultados = Equipo::select('tipoequipos.id as id_tipo', 'tipoequipos.nombre as nombre', 'serial', 'bien_nacional', 'marcas.nombre as marca', 'modelos.nombre as modelo')
                ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
                ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
                ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
                ->where('user_id', $usuario)
                ->where('tipoequipos.id', $bien)
                ->get()
            ;

            $equipos = array_merge($equipos, $resultados->toArray());
        }

        $fecha = now()->format('d-m-Y');

        $cargo = Cargo::find($user->cargo_id);

        $control = NroControl::whereNotNull('salida')->latest()->first()->salida;

        $nro = ++$control;

        NroControl::create(['salida' => $nro]);

        $nota = 'SALIDA';

        $pdf = Pdf::loadView('pdfs.notas.entrega', ['equipos' => $equipos, 'bienes' => $bienes, 'user' => $user, 'fecha' => $fecha, 'cargo' => $cargo, 'nro' => $nro, 'observacion' => $observacion, 'nota' => $nota]);

        //return view('pdfs.notas.entrega', compact('equipos', 'bienes', 'user', 'fecha', 'cargo'));

        return $pdf->download('salida.pdf');
    }
}
