<?php

namespace App\Http\Livewire\MiEquipo;

use App\Models\Equipo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
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

        return view('livewire.mi-equipo.index', compact('misEquipos'));
    }
}
