<?php

namespace App\Http\Livewire\Equipo;

use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Rolequipo;
use App\Models\Tipoequipo;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $equipo;

    public $tipo, $marca, $modelo, $serial, $bien_nacional, $rol, $usuario;

    public $marcas = [], $modelos = [];

    public function mount()
    {
        $marca = $this->equipo->id_marca;

        $this->marcas = Marca::all();
        $this->modelos = Modelo::all()->where('marca_id', $marca);

        $this->tipo = $this->equipo->id_tipo;
        $this->marca = $this->equipo->id_marca;
        $this->modelo = $this->equipo->id_modelo;
        $this->serial = $this->equipo->serial;
        $this->bien_nacional = $this->equipo->bien_nacional;
        $this->rol = $this->equipo->id_rol;
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
            'usuario' => 'required',
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
        $validatedData = $this->validate();

        $equipo = Equipo::find($this->equipo->id);

        $equipo->update([
            'tipoequipo_id' => $this->tipo,
            'marca_id' => $this->marca,
            'modelo_id' => $this->modelo,
            'serial' => $this->serial,
            'bien_nacional' => $this->bien_nacional,
            'rolequipo_id' => $this->rol,
            'user_id' => $this->usuario,
        ]);

        return redirect()
            ->route('equipos.index')
            ->with('actualizar', 'Registro actualizado con exito')
        ;
    }

    public function render()
    {
        $equipos = Tipoequipo::all();
        //$marcas = Marca::all();
        //$modelos = Modelo::all();
        $roles = Rolequipo::all();
        $users = User::all();

        return view('livewire.equipo.edit', compact('equipos', 'roles', 'users'));
    }
}
