<?php

namespace App\Http\Livewire\Inventario;

use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Rolequipo;
use App\Models\Tipoequipo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $tipo, $marca, $modelo, $serial, $bien_nacional, $bien_pdvsa, $bien_menpet, $rol;

    public $marcas = [], $modelos = [];

    protected $rules = [
        'tipo' => 'required',
        'marca' => 'required',
        'modelo' => 'required',
        'serial' => 'nullable|min:5|unique:equipos,serial',
        'bien_nacional' => 'nullable|integer|min:1|max:4999|unique:equipos,bien_nacional',
        'bien_pdvsa' => 'nullable|integer|min:100|max:9999999|unique:equipos,bien_pdvsa',
        'bien_menpet' => 'nullable|integer|min:100|max:999999|unique:equipos,bien_menpet',
    ];

    public function mount()
    {
        $this->marcas = Marca::all();
        $this->modelos = collect();

        $this->rol = Rolequipo::where('rol', 'Disponible')->first();
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

    public function crear()
    {
        $this->validate();

        $user = Auth::User()->name;

        if (!$this->bien_nacional)
        {
            $this->bien_nacional = 0;
        }

        if (!$this->serial)
        {
            $this->serial = ' ';
        }

        Equipo::create([
            'tipoequipo_id' => $this->tipo,
            'marca_id' => $this->marca,
            'modelo_id' => $this->modelo,
            'serial' => $this->serial,
            'bien_nacional' => $this->bien_nacional,
            'bien_pdvsa' => $this->bien_pdvsa,
            'bien_menpet' => $this->bien_menpet,
            'rolequipo_id' => $this->rol->id,
            'creado' => $user
        ]);

        return redirect()->route('inventario.index')->with('crear', 'Equipo Registrado con Exito');
    }

    public function render()
    {
        $equipos = Tipoequipo::all();

        return view('livewire.inventario.create', compact('equipos'));
    }
}
