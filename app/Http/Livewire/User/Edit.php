<?php

namespace App\Http\Livewire\User;

use App\Models\Cargo;
use App\Models\Departamento;
use App\Models\Ubicacion;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $password, $confirPass, $id_user, $departamento, $ubicacion, $cargo;

    protected $rules = [
        'password' => 'required|min:8',
        'confirPass' => 'required|same:password',
    ];

    public function mount()
    {
        $this->departamento = User::find($this->id_user)->departamento_id;
        $this->ubicacion = User::find($this->id_user)->ubicacion_id;
        $this->cargo = User::find($this->id_user)->cargo_id;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function editar()
    {
        $this->validate();

        $user = User::find($this->id_user);

        $user->update(['password' => bcrypt($this->password)]);

        return redirect()->route('users.edit', $user)->with('info', 'Contraseña Actualizada con Exito');
    }

    public function editar_departamento()
    {
        $user = User::find($this->id_user);

        $user->update(['departamento_id' => $this->departamento]);

        return redirect()->route('users.edit', $user)->with('info', 'Departamento actualizado con Exito');
    }

    public function editar_ubicacion()
    {
        $user = User::find($this->id_user);

        $user->update(['ubicacion_id' => $this->ubicacion]);

        return redirect()->route('users.edit', $user)->with('info', 'Ubicación Actualizada con Exito');
    }

    public function editar_cargo()
    {
        $user = User::find($this->id_user);

        $user->update(['cargo_id' => $this->cargo]);

        return redirect()->route('users.edit', $user)->with('info', 'Cargo Actualizado con Exito');
    }

    public function render()
    {
        $departamentos = Departamento::all();
        $ubicaciones = Ubicacion::all();
        $cargos = Cargo::all();

        return view('livewire.user.edit', compact('departamentos', 'ubicaciones', 'cargos'));
    }
}
