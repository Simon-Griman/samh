<?php

namespace App\Http\Livewire\User;

use App\Models\Departamento;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $password, $confirPass, $id_user, $departamento;

    protected $rules = [
        'password' => 'required|min:8',
        'confirPass' => 'required|same:password',
    ];

    public function mount()
    {
        $this->departamento = User::find($this->id_user)->departamento_id;
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

        return redirect()->route('users.edit', $user)->with('info', 'Contraseña Actualizada con Exito');
    }

    public function render()
    {
        $departamentos = Departamento::all();

        return view('livewire.user.edit', compact('departamentos'));
    }
}
