<?php

namespace App\Http\Livewire\Inventario;

use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Tipoequipo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
    public $equipo;

    public $tipo, $marca, $modelo, $serial, $bien_nacional, $bien_pdvsa, $bien_menpet;

    public $marcas = [], $modelos = [];

    public function mount()
    {
        $marca = $this->equipo->marca_id;

        $this->marcas = Marca::all();
        $this->modelos = Modelo::all()->where('marca_id', $marca);

        $this->tipo = $this->equipo->tipoequipo_id;
        $this->marca = $this->equipo->marca_id;
        $this->modelo = $this->equipo->modelo_id;
        $this->serial = $this->equipo->serial;
        $this->bien_nacional = $this->equipo->bien_nacional;
        $this->bien_pdvsa = $this->equipo->bien_pdvsa;
        $this->bien_menpet = $this->equipo->bien_menpet;
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
        ];
    }

    public function updatedMarca($value)
    {
        $this->modelos = Modelo::where('marca_id', $value)->get();
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

        $equipo->update([
            'tipoequipo_id' => $this->tipo,
            'marca_id' => $this->marca,
            'modelo_id' => $this->modelo,
            'serial' => $this->serial,
            'bien_nacional' => $this->bien_nacional,
            'bien_pdvsa' => $this->bien_pdvsa,
            'bien_menpet' => $this->bien_menpet,
            'actualizado' => $user,
        ]);

        return redirect()
            ->route('inventario.index')
            ->with('actualizar', 'Registro actualizado con exito')
        ;
    }

    public function render()
    {
        $equipos = Tipoequipo::all();

        return view('livewire.inventario.edit', compact('equipos'));
    }
}
