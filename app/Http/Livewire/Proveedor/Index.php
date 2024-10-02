<?php

namespace App\Http\Livewire\Proveedor;

use App\Models\Proveedor;
use Livewire\Component;

class Index extends Component
{
    public $borrar, $proveedor_borrar, $crear = true, $proveedor, $id_proveedor;

    protected $rules = [
        'proveedor' => 'required|unique:proveedors,nombre'
    ];

    public function modalCrear()
    {
        $this->crear = true;
        $this->limpiarCampos();
    }

    public function crear()
    {
        $this->validate();
        Proveedor::create(['nombre' => $this->proveedor]);
        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');
    }

    public function modalEditar($id)
    {
        $this->crear = false;

        $proveedor = Proveedor::findOrFail($id);

        $this->id_proveedor = $id;
        $this->proveedor = $proveedor->nombre;
    }

    public function editar()
    {
        $this->validate();

        $proveedor = Proveedor::find($this->id_proveedor);

        $proveedor->update(['nombre' => $this->proveedor]);

        $this->limpiarCampos();

        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->id_proveedor = '';
        $this->proveedor = '';
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->proveedor_borrar = Proveedor::find($id)->nombre;
    }

    public function borrar()
    {
        Proveedor::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $proveedores = Proveedor::all();

        return view('livewire.proveedor.index', compact('proveedores'));
    }
}
