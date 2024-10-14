<?php

namespace App\Http\Livewire\Cargo;

use App\Models\Cargo;
use Livewire\Component;

class Index extends Component
{
    public $borrar, $cargo_borrar, $crear = true, $cargo, $id_cargo;

    protected $rules = [
        'cargo' => 'required|unique:cargos,nombre'
    ];

    public function modalCrear()
    {
        $this->crear = true;
        $this->limpiarCampos();
    }

    public function crear()
    {
        $this->validate();
        Cargo::create(['nombre' => $this->cargo]);
        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');
    }

    public function modalEditar($id)
    {
        $this->crear = false;

        $cargo = Cargo::findOrFail($id);

        $this->id_cargo = $id;
        $this->cargo = $cargo->nombre;
    }

    public function editar()
    {
        $this->validate();

        $cargo = Cargo::find($this->id_cargo);

        $cargo->update(['nombre' => $this->cargo]);

        $this->limpiarCampos();

        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->id_cargo = '';
        $this->cargo = '';
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->cargo_borrar = Cargo::find($id)->nombre;
    }

    public function borrar()
    {
        Cargo::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $cargos = Cargo::all();

        return view('livewire.cargo.index', compact('cargos'));
    }
}
