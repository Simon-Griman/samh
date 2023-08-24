<?php

namespace App\Http\Livewire\Equipo;

use App\Models\Departamento;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Rolequipo;
use App\Models\Tipoequipo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
    public $equipo;

    public $tipo, $marca, $modelo, $serial, $bien_nacional, $rol, $observacion, $departamento, $usuario;

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
        $this->rol = $this->equipo->id_rol;
        $this->departamento = $this->equipo->id_departamento;
        $this->usuario = $this->equipo->id_user;

    }

    protected function rules()
    {
        return [
            'tipo' => 'required',
            'marca' => 'required',
            'modelo' => 'required',
            'serial' => 'nullable|min:5|unique:equipos,serial,' . $this->equipo->id,
            'bien_nacional' => 'nullable|integer|min:100|max:4999|unique:equipos,bien_nacional,' . $this->equipo->id,
            'rol' => 'required',
            'observacion' => 'nullable',
            'departamento' => 'required',
            'usuario' => 'required',
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

        $equipo->update([
            'tipoequipo_id' => $this->tipo,
            'marca_id' => $this->marca,
            'modelo_id' => $this->modelo,
            'serial' => $this->serial,
            'bien_nacional' => $this->bien_nacional,
            'rolequipo_id' => $this->rol,
            'observacion' => $this->observacion,
            'departamento_id' => $this->departamento,
            'user_id' => $this->usuario,
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

        return view('livewire.equipo.edit', compact('equipos', 'roles'));
    }
}
