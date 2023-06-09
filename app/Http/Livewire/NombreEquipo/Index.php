<?php

namespace App\Http\Livewire\NombreEquipo;

use App\Models\Tipoequipo;
use Livewire\Component;

class Index extends Component
{
    public $borrar, $equipo_borrar, $crear = true, $equipo, $id_equipo;

    protected $rules = [
        'equipo' => 'required'
    ];

    public function modalCrear()
    {
        $this->crear = true;
        $this->limpiarCampos();
    }

    public function crear()
    {
        $this->validate();
        Tipoequipo::create(['nombre' => $this->equipo]);
        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');
    }

    public function modalEditar($id)
    {
        $this->crear = false;

        $equipo = Tipoequipo::findOrFail($id);

        $this->id_equipo = $id;
        $this->equipo = $equipo->nombre;
    }

    public function editar()
    {
        $this->validate();

        $equipo = Tipoequipo::find($this->id_equipo);

        $equipo->update(['nombre' => $this->equipo]);

        $this->limpiarCampos();

        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->id_equipo = '';
        $this->equipo = '';
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->equipo_borrar = Tipoequipo::find($id)->nombre;
    }

    public function borrar()
    {
        Tipoequipo::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $equipos = Tipoequipo::all();

        return view('livewire.nombre-equipo.index', compact('equipos'));
    }
}
