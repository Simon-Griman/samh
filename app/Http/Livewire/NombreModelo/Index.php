<?php

namespace App\Http\Livewire\NombreModelo;

use App\Models\Marca;
use App\Models\Modelo;
use Livewire\Component;

class Index extends Component
{
    public $borrar, $marca_borrar, $marcas, $nombre_marca, $modelos, $modelo, $id_modelo, $id_marca;

    protected $rules = [
        'modelo' => 'required',
        'id_modelo' => 'required'
    ];

    public function mount()
    {
        $this->marcas = Marca::all();
        $this->modelos = Modelo::all();
    }

    public function modalCrear($id)
    {
        $this->limpiarCampos();

        $marca = Marca::findOrFail($id);

        $this->id_marca = $id;
        $this->nombre_marca = $marca->nombre;

    }

    public function crear()
    {
        $this->id_modelo = 1;

        $this->validate();
        Modelo::create([
            'nombre' => $this->modelo,
            'marca_id' => $this->id_marca
        ]);
        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');

        $this->limpiarCampos();
    }

    public function modalEditar($id)
    {
        $marca = Marca::findOrFail($id);

        $this->id_marca = $id;
        $this->nombre_marca = $marca->nombre;
    }

    public function editar()
    {
        $this->validate();

        $modelo = Modelo::find($this->id_modelo);

        $modelo->update(['nombre' => $this->modelo]);

        $this->limpiarCampos();

        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->id_marca = '';
        $this->nombre_marca = '';
        $this->modelo = '';
        $this->id_modelo = '';
    }

    public function confirBorrar($id)
    {
        $this->id_marca = $id;
    }

    public function borrar()
    {
        Modelo::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');

        $this->limpiarCampos();
    }


    public function render()
    {
        return view('livewire.nombre-modelo.index');
    }
}
