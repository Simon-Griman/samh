<?php

namespace App\Http\Livewire\Equipo;

use App\Models\Biendependiente;
use App\Models\Equipo;
use Carbon\Carbon;
use Livewire\Component;

class Show extends Component
{
    public $equipo;

    public function render()
    {
        if($datos = Equipo::select('equipos.id', 'tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'modelos.id as id_modelo', 'modelos.nombre as modelo', 'equipos.serial', 'bien_nacional', 'bien_pdvsa', 'bien_menpet', 'rolequipos.rol as rol', 'creado', 'actualizado', 'equipos.created_at as f_creado', 'equipos.updated_at as f_actualizado', 'users.name as usuario', 'ubicacions.nombre as ubicacion', 'observacion', 'departamentos.nombre as departamento', 'fecha_adquisicion', 'tipoequipos.depreciacion', 'proveedors.nombre as proveedor', 'costo_compra')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
            ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
            ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
            ->join('departamentos', 'departamentos.id', '=', 'equipos.departamento_id')
            ->join('users', 'users.id', '=', 'equipos.user_id')
            ->join('ubicacions', 'ubicacions.id', '=', 'users.ubicacion_id')
            ->join('biendependientes', 'biendependientes.bien_nacional_id', '=', 'equipos.id')
            ->leftjoin('proveedors', 'proveedors.id', '=', 'equipos.proveedor_id')
            ->where('equipos.id', $this->equipo->id)
            ->first()
        )
        {
            $perifericos = true;
            $cont = 1;

            if ($datos->fecha_adquisicion)
            {
                $d_acumulada = Carbon::createFromFormat('Y-m-d', $datos->fecha_adquisicion);
                
                $acumulada = $d_acumulada->diffInDays(now());

                $d_mensual = intdiv($acumulada, 30);
            }

            else
            {
                $d_mensual = null;
            }

            $dependientes = Biendependiente::select('biendependientes.nombre as nombre', 'marcas.nombre as marca', 'modelos.nombre as modelo', 'biendependientes.serial')
                ->join('marcas', 'marcas.id', '=', 'biendependientes.marca_id')
                ->leftjoin('modelos', 'modelos.id', '=', 'biendependientes.modelo_id')
                ->join('equipos', 'equipos.id', '=', 'biendependientes.bien_nacional_id')
                ->where('equipos.id', $this->equipo->id)
                ->get()
            ;

            return view('livewire.equipo.show', compact('datos', 'perifericos', 'dependientes', 'cont', 'd_mensual'));
        }

        else
        {
            $datos = Equipo::select('equipos.id', 'tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'modelos.id as id_modelo', 'modelos.nombre as modelo', 'equipos.serial', 'bien_nacional', 'bien_pdvsa', 'bien_menpet', 'rolequipos.rol as rol', 'creado', 'actualizado', 'equipos.created_at as f_creado', 'equipos.updated_at as f_actualizado', 'users.name as usuario', 'ubicacions.nombre as ubicacion', 'observacion', 'departamentos.nombre as departamento', 'fecha_adquisicion', 'tipoequipos.depreciacion', 'proveedors.nombre as proveedor', 'costo_compra')
                ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
                ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
                ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
                ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
                ->join('departamentos', 'departamentos.id', '=', 'equipos.departamento_id')
                ->join('users', 'users.id', '=', 'equipos.user_id')
                ->join('ubicacions', 'ubicacions.id', '=', 'users.ubicacion_id')
                //->join('biendependientes', 'biendependientes.bien_nacional_id', '=', 'equipos.id')
                ->leftjoin('proveedors', 'proveedors.id', '=', 'equipos.proveedor_id')
                ->where('equipos.id', $this->equipo->id)
                ->first()
            ;

            $perifericos = false;

            if ($datos->fecha_adquisicion)
            {
                $d_acumulada = Carbon::createFromFormat('Y-m-d', $datos->fecha_adquisicion);
                
                $acumulada = $d_acumulada->diffInDays(now());

                $d_mensual = intdiv($acumulada, 30);
            }

            else
            {
                $d_mensual = null;
            }

            return view('livewire.equipo.show', compact('datos', 'perifericos', 'd_mensual'));
        }
    }
}