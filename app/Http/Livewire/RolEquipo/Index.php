<?php

namespace App\Http\Livewire\RolEquipo;

use App\Models\Marca;
use App\Models\Rolequipo;
use Livewire\Component;

class Index extends Component
{
    public $borrar, $rol_borrar, $crear = true, $rol, $id_rol;

    protected $rules = [
        'rol' => 'required'
    ];

    public function modalCrear()
    {
        $this->crear = true;
        $this->limpiarCampos();
    }

    public function crear()
    {
        $this->validate();
        Rolequipo::create(['rol' => $this->rol]);
        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');
    }

    public function modalEditar($id)
    {
        $this->crear = false;

        $rol = Rolequipo::findOrFail($id);

        $this->id_rol = $id;
        $this->rol = $rol->rol;
    }

    public function editar()
    {
        $this->validate();

        $rol = Rolequipo::find($this->id_rol);

        $rol->update(['rol' => $this->rol]);

        $this->limpiarCampos();

        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->id_rol = '';
        $this->rol = '';
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->rol_borrar = Rolequipo::find($id)->rol;
    }

    public function borrar()
    {
        Rolequipo::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }


    public function render()
    {
        $roles = Rolequipo::all();

        return view('livewire.rol-equipo.index', compact('roles'));
    }
}
