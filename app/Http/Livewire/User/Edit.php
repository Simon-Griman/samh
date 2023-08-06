<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $password, $confirPass, $id_user;

    protected $rules = [
        'password' => 'required|min:8',
        'confirPass' => 'required|same:password',
    ];

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

    public function render()
    {
        return view('livewire.user.edit');
    }
}
