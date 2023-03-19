<?php

namespace App\Http\Livewire\Equipo;

use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Rolequipo;
use App\Models\Tipoequipo;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $tipo, $marca, $modelo, $serial, $bien_nacional, $rol, $usuario;

    public $marcas = [], $modelos = [];

    protected $rules = [
        'tipo' => 'required',
        'marca' => 'required',
        'modelo' => 'required',
        'serial' => 'nullable|min:5|unique:equipos,serial',
        'bien_nacional' => 'nullable|integer|min:100|max:4999|unique:equipos,bien_nacional',
        'rol' => 'required',
        'usuario' => 'required',
    ];

    public function mount()
    {
        $this->marcas = Marca::all();
        $this->modelos = collect();
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

        Equipo::create([
            'tipoequipo_id' => $this->tipo,
            'marca_id' => $this->marca,
            'modelo_id' => $this->modelo,
            'serial' => $this->serial,
            'bien_nacional' => $this->bien_nacional,
            'rolequipo_id' => $this->rol,
            'user_id' => $this->usuario,
        ]);

        return redirect()->route('equipos.index')->with('crear', 'Equipo Registrado con Exito');
    }

    public function render()
    {
        $equipos = Tipoequipo::all();
        $roles = Rolequipo::all();
        $users = User::all();

        return view('livewire.equipo.create', compact('equipos', 'roles', 'users'));
    }
}
