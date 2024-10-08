<?php

namespace App\Http\Livewire\Equipo;

use App\Models\Departamento;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Proveedor;
use App\Models\Rolequipo;
use App\Models\Tipoequipo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    public $tipo, $marca, $modelo, $serial, $bien_nacional, $bien_pdvsa, $bien_menpet, $rol, $observacion, $departamento, $usuario, $adquisicion, $depreciacion, $proveedor;

    public $marcas = [], $modelos = [], $departamentos = [], $users = [];

    protected $rules = [
        'tipo' => 'required',
        'marca' => 'required',
        'modelo' => 'required',
        'serial' => 'nullable|min:5|unique:equipos,serial',
        'bien_nacional' => 'nullable|integer|min:1|max:4999|unique:equipos,bien_nacional',
        'bien_pdvsa' => 'nullable|integer|min:100|max:9999999|unique:equipos,bien_pdvsa',
        'bien_menpet' => 'nullable|integer|min:100|max:999999|unique:equipos,bien_menpet',
        'rol' => 'required',
        'observacion' => 'nullable',
        'departamento' => 'required',
        'usuario' => 'required',
        'adquisicion' => 'nullable|date|before_or_equal:today',
        'depreciacion' => 'nullable',
        'proveedor' => 'nullable',
    ];

    public function mount()
    {
        $this->marcas = Marca::all();
        $this->departamentos = Departamento::all();

        $this->modelos = collect();
        $this->users = collect();
    }

    public function updatedMarca($value)
    {
        $this->modelos = Modelo::where('marca_id', $value)->get();
        $this->modelo = $this->modelos->first()->id ?? null;
    }

    public function updatedDepartamento($value)
    {
        $this->users = User::where('departamento_id', $value)->orderBy('name')->get();
        $this->usuario = $this->users->first()->id ?? null;
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

        if (empty($this->adquisicion))
        {
            $this->adquisicion = null; 
        }

        if (empty($this->proveedor))
        {
            $this->proveedor = null;
        }

        if (empty($this->depreciacion))
        {
            $this->depreciacion = null;
        }

        Equipo::create([
            'tipoequipo_id' => $this->tipo,
            'marca_id' => $this->marca,
            'modelo_id' => $this->modelo,
            'serial' => $this->serial,
            'bien_nacional' => $this->bien_nacional,
            'bien_pdvsa' => $this->bien_pdvsa,
            'bien_menpet' => $this->bien_menpet,
            'rolequipo_id' => $this->rol,
            'observacion' => $this->observacion,
            'departamento_id' => $this->departamento,
            'user_id' => $this->usuario,
            'fecha_adquisicion' => $this->adquisicion,
            'depreciacion' => $this->depreciacion,
            'proveedor_id' => $this->proveedor,
            'creado' => $user,
        ]);

        return redirect()->route('equipos.index')->with('crear', 'Equipo Registrado con Exito');
    }

    public function render()
    {
        $equipos = Tipoequipo::all();
        $roles = Rolequipo::all();
        $proveedores = Proveedor::all();

        return view('livewire.equipo.create', compact('equipos', 'roles', 'proveedores'));
    }
}
