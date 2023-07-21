<?php

namespace App\Http\Livewire\NombreMarca;

use App\Models\Marca;
use Livewire\Component;

class Index extends Component
{

    public $borrar, $marca_borrar, $crear = true, $marca, $id_marca;

    protected $rules = [
        'marca' => 'required'
    ];

    public function modalCrear()
    {
        $this->crear = true;
        $this->limpiarCampos();
    }

    public function crear()
    {
        $this->validate();
        Marca::create(['nombre' => $this->marca]);
        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');
    }

    public function modalEditar($id)
    {
        $this->crear = false;

        $marca = Marca::findOrFail($id);

        $this->id_marca = $id;
        $this->marca = $marca->nombre;
    }

    public function editar()
    {
        $this->validate();

        $marca = Marca::find($this->id_marca);

        $marca->update(['nombre' => $this->marca]);

        $this->limpiarCampos();

        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->id_marca = '';
        $this->marca = '';
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->marca_borrar = Marca::find($id)->nombre;
    }

    public function borrar()
    {
        Marca::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }


    public function render()
    {
        $marcas = Marca::all();

        return view('livewire.nombre-marca.index', compact('marcas'));
    }
}
