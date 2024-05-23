<?php

namespace App\Http\Livewire\Almacen;

use App\Models\Almacen;
use App\Models\Articulo;
use Livewire\Component;

class Create extends Component
{
    public $descripcion, $unidad, $entrada, $hola;

    protected $rules = [
        'descripcion' => 'required|unique:almacens,articulo_id',
        'unidad' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function crear()
    {
        $this->validate();

        Almacen::create([
            'articulo_id' => $this->descripcion,
            'tipo_unidad' => $this->unidad,
            'entrada' => 0,
            'salida' => 0,
        ]);

        return redirect()->route('almacen.index')->with('crear', 'Articulo Registrado con Exito');
    }

    public function render()
    {
        $articulos = Articulo::all();

        return view('livewire.almacen.create', compact('articulos'));
    }
}
