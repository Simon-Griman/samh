<?php

namespace App\Http\Livewire\Articulo;

use App\Models\Articulo;
use Livewire\Component;

class Index extends Component
{
    public $articulo, $id_articulo, $crear=true, $borrar, $articulo_borrar;

    protected $rules = [
        'articulo' => 'required|unique:articulos,nombre'
    ];

    public function modalCrear()
    {
        $this->crear = true;
        $this->limpiarCampos();
    }

    public function crear()
    {
        $this->validate();
        Articulo::create(['nombre' => $this->articulo]);
        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');
    }

    public function modalEditar($id)
    {
        $this->crear = false;

        $articulo = Articulo::findOrFail($id);

        $this->id_articulo = $id;
        $this->articulo = $articulo->nombre;
    }

    public function editar()
    {
        $this->validate();

        $articulo = Articulo::find($this->id_articulo);

        $articulo->update(['nombre' => $this->articulo]);

        $this->limpiarCampos();

        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->id_articulo = '';
        $this->articulo = '';
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->articulo_borrar = Articulo::find($id)->nombre;
    }

    public function borrar()
    {
        Articulo::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $articulos = Articulo::all();

        return view('livewire.articulo.index', compact('articulos'));
    }
}
