<?php

namespace App\Http\Livewire\Almacen;

use App\Models\Almacen;
use App\Models\Articulo;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $descripcion, $unidad, $unidad2, $nombre, $entrada, $salida, $articulo_id, $max;

    protected function rules()
    {
        return [
            'entrada' => 'nullable|integer|min:1',
            'salida' => 'nullable|integer|min:1|max:' . $this->max
        ];
    }

    public function entrada($nombre, $unidad)
    {
        $this->entrada = '';
        $this->nombre = $nombre;
        $this->unidad = $unidad;
    }

    public function entrada_crear()
    {
        $this->validate();

        $this->articulo_id = Articulo::where('nombre', $this->nombre)->first()->id;

        Almacen::create([
            'articulo_id' => $this->articulo_id,
            'tipo_unidad' => $this->unidad,
            'entrada' => $this->entrada,
            'fecha_entrada' => now(),
        ]);

        $this->dispatchBrowserEvent('crear');
    }

    public function salida($nombre, $unidad)
    {
        $this->salida = '';
        $this->nombre = $nombre;
        $this->unidad = $unidad;

        $this->articulo_id = Articulo::where('nombre', $this->nombre)->first()->id;

        $entrada = Almacen::where('articulo_id', $this->articulo_id)->sum('entrada');
        $salida = Almacen::where('articulo_id', $this->articulo_id)->sum('salida');

        $this->max = $entrada - $salida;
    }

    public function salida_crear()
    {
        $this->validate();

        $this->articulo_id = Articulo::where('nombre', $this->nombre)->first()->id;

        Almacen::create([
            'articulo_id' => $this->articulo_id,
            'tipo_unidad' => $this->unidad,
            'salida' => $this->salida,
            'fecha_salida' => now(),
        ]);

        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $almacen = DB::table('view_almacen')
            ->where('nombre', 'LIKE', '%' . $this->descripcion . '%')
            ->where('tipo_unidad', 'LIKE', '%' . $this->unidad2 . '%')
            ->get()
        ;

        $articulos = Articulo::orderBy('nombre')->get();

        $registros = Almacen::select('*', 'nombre')
            ->join('articulos', 'articulos.id', '=', 'almacens.articulo_id')
            ->get()
        ;

        return view('livewire.almacen.index', compact('almacen', 'articulos', 'registros'));
    }
}