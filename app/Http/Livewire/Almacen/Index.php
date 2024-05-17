<?php

namespace App\Http\Livewire\Almacen;

use App\Models\Almacen;
use App\Models\Articulo;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $articulo, $tipo_unidad, $entrada, $fecha_entrada, $salida, $fecha_salida;

    public function render()
    {
        $almacen = Almacen::select('*', 'nombre')
            ->join('articulos', 'articulos.id', '=', 'almacens.articulo_id')
            ->where('nombre', 'LIKE', '%' . $this->articulo . '%')
            ->paginate()
        ;

        $articulos = Articulo::orderBy('nombre')->get();

        return view('livewire.almacen.index', compact('almacen', 'articulos'));
    }
}
