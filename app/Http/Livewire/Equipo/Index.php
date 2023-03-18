<?php

namespace App\Http\Livewire\Equipo;

use App\Models\Equipo;
use Livewire\Component;

class Index extends Component
{
    //public $equipos;

    public $borrar, $bn_borrar;

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->bn_borrar = Equipo::find($id)->bien_nacional;
    }

    public function borrar()
    {
        Equipo::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }
    
    public function render()
    {
        $equipos = Equipo::select('equipos.id', 'tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'modelos.id as id_modelo', 'modelos.nombre as modelo', 'serial', 'bien_nacional', 'rolequipos.id as id_rol', 'rol', 'users.id as id_user', 'name')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
            ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
            ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
            ->join('users', 'users.id', '=', 'equipos.user_id')
            ->get()
        ;

        return view('livewire.equipo.index', compact('equipos'));
    }
}
