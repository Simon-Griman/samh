<?php

namespace App\Http\Livewire\Equipo;

use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Rolequipo;
use App\Models\Tipoequipo;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $tipo, $marca, $modelo, $serial, $bien_nacional, $rol, $usuario;

    public $borrar, $bn_borrar;

    protected $paginationTheme = "bootstrap";

    public function updatingTipo()
    {
        $this->resetPage();
    }

    public function updatingMarca()
    {
        $this->resetPage();
    }

    public function updatingModelo()
    {
        $this->resetPage();
    }

    public function updatingSerial()
    {
        $this->resetPage();
    }

    public function updatingBien_nacional()
    {
        $this->resetPage();
    }

    public function updatingRol()
    {
        $this->resetPage();
    }

    public function updatingUsuario()
    {
        $this->resetPage();
    }

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
            ->where('tipoequipos.nombre', 'LIKE', '%' . $this->tipo . '%')
            ->where('marcas.nombre', 'LIKE', '%' . $this->marca . '%')
            ->where('modelos.nombre', 'LIKE', '%' . $this->modelo . '%')
            ->where('serial', 'LIKE', '%' . $this->serial . '%')
            ->where('bien_nacional', 'LIKE', '%' . $this->bien_nacional . '%')
            ->where('rol', 'LIKE', '%' . $this->rol . '%')
            ->where('name', 'LIKE', '%' . $this->usuario . '%')
            ->get()
        ;

        $tipos = Tipoequipo::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $roles = Rolequipo::all();
        $usuarios = User::all();

        return view('livewire.equipo.index', compact('equipos', 'tipos', 'marcas', 'modelos', 'roles', 'usuarios'));
    }
}
