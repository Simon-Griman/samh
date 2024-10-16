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
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
    public $equipo;

    public $tipo, $marca, $modelo, $serial, $bien_nacional, $bien_pdvsa, $bien_menpet, $rol, $observacion, $departamento, $usuario, $fecha_adquisicion, $proveedor;

    public $marcas = [], $modelos = [], $departamentos = [], $users = [];

    public function mount()
    {
        $marca = $this->equipo->id_marca;
        $departamento = $this->equipo->id_departamento;

        $this->marcas = Marca::all();
        $this->modelos = Modelo::all()->where('marca_id', $marca);

        $this->departamentos = Departamento::all();
        $this->users = User::all()->where('departamento_id', $departamento);

        $this->tipo = $this->equipo->id_tipo;
        $this->marca = $this->equipo->id_marca;
        $this->modelo = $this->equipo->id_modelo;
        $this->serial = $this->equipo->serial;
        $this->bien_nacional = $this->equipo->bien_nacional;
        $this->bien_pdvsa = $this->equipo->bien_pdvsa;
        $this->bien_menpet = $this->equipo->bien_menpet;
        $this->rol = $this->equipo->id_rol;
        $this->observacion = $this->equipo->observacion;
        $this->departamento = $this->equipo->id_departamento;
        $this->usuario = $this->equipo->id_user;
        $this->fecha_adquisicion = $this->equipo->fecha_adquisicion;
        $this->proveedor = $this->equipo->id_proveedor;
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
            'rol' => 'required',
            'observacion' => 'nullable',
            'departamento' => 'required',
            'usuario' => 'required',
            'fecha_adquisicion' => 'nullable|date|before_or_equal:today',
            'proveedor' => 'nullable',
        ];
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

        $equipo->update([
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
            'fecha_adquisicion' => $this->fecha_adquisicion,
            'proveedor_id' => $this->proveedor,
            'actualizado' => $user,
        ]);

        return redirect()
            ->route('equipos.index')
            ->with('actualizar', 'Registro actualizado con exito')
        ;
    }

    public function render()
    {
        $equipos = Tipoequipo::all();
        $roles = Rolequipo::all();
        $proveedores = Proveedor::all();

        return view('livewire.equipo.edit', compact('equipos', 'roles', 'proveedores'));
    }
}
