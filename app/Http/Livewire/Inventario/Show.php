<?php

namespace App\Http\Livewire\Inventario;

use App\Models\Equipo;
use Livewire\Component;

class Show extends Component
{
    public $equipo;

    public function render()
    {
        $datos = Equipo::select('equipos.id', 'tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'modelos.id as id_modelo', 'modelos.nombre as modelo', 'serial', 'bien_nacional', 'rolequipos.rol as rol', 'creado', 'actualizado', 'equipos.created_at as f_creado', 'equipos.updated_at as f_actualizado')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
            ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
            ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
            ->where('equipos.id', $this->equipo->id)
            ->first()
        ;

        return view('livewire.inventario.show', compact('datos'));
    }
}
