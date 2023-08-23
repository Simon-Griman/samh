<?php

namespace App\Http\Livewire\User;

use App\Models\Departamento;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{
    public $name, $email, $cedula, $password, $confirPass, $departamento;

    public $departamentos = [];

    protected $rules = [
        'name' => 'required',
        'email' => 'required|unique:users,email',
        'cedula' => 'required|integer|min:1000000|max:50000000|unique:users,cedula',
        'departamento' => 'required',
    ];

    public function mount()
    {
        $this->departamentos = Departamento::all();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function crear()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'cedula' => $this->cedula,
            'departamento_id' => $this->departamento,
        ])->assignRole('Nuevo-Usuario');

        return redirect()->route('users.index')->with('info', 'Usuario Registrado con Exito');
    }

    public function render()
    {
        return view('livewire.user.create');
    }
}
