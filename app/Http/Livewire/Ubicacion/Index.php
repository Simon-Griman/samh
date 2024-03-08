<?php

namespace App\Http\Livewire\Ubicacion;

use App\Models\Ubicacion;
use Livewire\Component;

class Index extends Component
{
    public $borrar, $ubicacion_borrar, $crear = true, $ubicacion, $id_ubicacion;

    protected $rules = [
        'ubicacion' => 'required|unique:ubicacions,nombre'
    ];

    public function modalCrear()
    {
        $this->crear = true;
        $this->limpiarCampos();
    }

    public function crear()
    {
        $this->validate();
        Ubicacion::create(['nombre' => $this->ubicacion]);
        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');
    }

    public function modalEditar($id)
    {
        $this->crear = false;

        $ubicacion = Ubicacion::findOrFail($id);

        $this->id_ubicacion = $id;
        $this->ubicacion = $ubicacion->nombre;
    }

    public function editar()
    {
        $this->validate();

        $ubicacion = Ubicacion::find($this->id_ubicacion);

        $ubicacion->update(['nombre' => $this->ubicacion]);

        $this->limpiarCampos();

        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->id_ubicacion = '';
        $this->ubicacion = '';
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->ubicacion_borrar = Ubicacion::find($id)->nombre;
    }

    public function borrar()
    {
        Ubicacion::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }


    public function render()
    {
        $ubicaciones = Ubicacion::all();

        return view('livewire.ubicacion.index', compact('ubicaciones'));
    }
}
