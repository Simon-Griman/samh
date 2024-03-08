<?php

namespace App\Http\Livewire\Departamento;

use App\Models\Departamento;
use App\Models\Tipoequipo;
use Livewire\Component;

class Index extends Component
{
    public $borrar, $departamento_borrar, $crear = true, $departamento, $id_departamento;

    protected $rules = [
        'departamento' => 'required|unique:departamentos,nombre'
    ];

    public function modalCrear()
    {
        $this->crear = true;
        $this->limpiarCampos();
    }

    public function crear()
    {
        $this->validate();
        Departamento::create(['nombre' => $this->departamento]);
        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');
    }

    public function modalEditar($id)
    {
        $this->crear = false;

        $departamento = Departamento::findOrFail($id);

        $this->id_departamento = $id;
        $this->departamento = $departamento->nombre;
    }

    public function editar()
    {
        $this->validate();

        $departamento = Departamento::find($this->id_departamento);

        $departamento->update(['nombre' => $this->departamento]);

        $this->limpiarCampos();

        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->id_departamento = '';
        $this->departamento = '';
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->departamento_borrar = Departamento::find($id)->nombre;
    }

    public function borrar()
    {
        Departamento::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $departamentos = Departamento::all();

        return view('livewire.departamento.index', compact('departamentos'));
    }
}
