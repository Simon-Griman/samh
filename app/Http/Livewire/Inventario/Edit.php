<?php

namespace App\Http\Livewire\Inventario;

use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Proveedor;
use App\Models\Tipoequipo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
    public $equipo;

    public $tipo, $marca, $modelo, $serial, $bien_nacional, $bien_pdvsa, $bien_menpet, $fecha_adquisicion, $proveedor, $costo_compra;

    public $marcas = [], $modelos = [];

    public function mount()
    {
        $marca = $this->equipo->marca_id;

        $this->marcas = Marca::orderBy('nombre')->get();
        $this->modelos = Modelo::where('marca_id', $marca)->orderBy('nombre')->get();

        $this->tipo = $this->equipo->tipoequipo_id;
        $this->marca = $this->equipo->marca_id;
        $this->modelo = $this->equipo->modelo_id;
        $this->serial = $this->equipo->serial;
        $this->bien_nacional = $this->equipo->bien_nacional;
        $this->bien_pdvsa = $this->equipo->bien_pdvsa;
        $this->bien_menpet = $this->equipo->bien_menpet;
        $this->fecha_adquisicion = $this->equipo->fecha_adquisicion;
        $this->proveedor = $this->equipo->proveedor_id;
        $this->costo_compra = $this->equipo->costo_compra;

        if ($this->bien_nacional == 0)
        {
            $this->bien_nacional = null;
        }
    }

    protected function rules()
    {
        return [
            'tipo' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'serial' => 'nullable|min:5|unique:equipos,serial,' . $this->equipo->id,
            'bien_nacional' => 'nullable|integer|min:1|max:4999|unique:equipos,bien_nacional,' . $this->equipo->id,
            'bien_pdvsa' => 'nullable|integer|min:100|max:9999999|unique:equipos,bien_pdvsa,' . $this->equipo->id,
            'bien_menpet' => 'nullable|integer|min:100|max:999999|unique:equipos,bien_menpet,' . $this->equipo->id,
            'fecha_adquisicion' => 'nullable',
            'proveedor' => 'nullable',
            'costo_compra' => 'nullable|integer|min:0'
        ];
    }

    public function updatedMarca($value)
    {
        $this->modelos = Modelo::where('marca_id', $value)->orderBy('nombre')->get();
        $this->modelo = $this->modelos->first()->id ?? null;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function actualizar()
    {
        $this->validate();

        $user = Auth::User()->name;

        $equipo = Equipo::find($this->equipo->id);

        if (!$this->bien_nacional)
        {
            $this->bien_nacional = 0;
        }

        if (!$this->serial)
        {
            $this->serial = ' ';
        }

        if (empty($this->fecha_adquisicion))
        {
            $this->fecha_adquisicion = null;
        }

        if (empty($this->proveedor))
        {
            $this->proveedor = null;
        }

        if (empty($this->costo_compra))
        {
            $this->costo_compra = null;
        }

        $equipo->update([
            'tipoequipo_id' => $this->tipo,
            'marca_id' => $this->marca,
            'modelo_id' => $this->modelo,
            'serial' => $this->serial,
            'bien_nacional' => $this->bien_nacional,
            'bien_pdvsa' => $this->bien_pdvsa,
            'bien_menpet' => $this->bien_menpet,
            'fecha_adquisicion' => $this->fecha_adquisicion,
            'proveedor_id' => $this->proveedor,
            'costo_compra' => $this->costo_compra,
            'actualizado' => $user,
        ]);

        return redirect()
            ->route('inventario.index')
            ->with('actualizar', 'Registro actualizado con exito')
        ;
    }

    public function render()
    {
        $equipos = Tipoequipo::orderBy('nombre')->get();
        $proveedores = Proveedor::orderBy('nombre')->get();

        return view('livewire.inventario.edit', compact('equipos', 'proveedores'));
    }
}
