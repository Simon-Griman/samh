<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ExportarEquipo extends Component
{
    public $users, $departamentos, $ubicaciones, $roles;

    public $usuario = 0, $departamento = 0, $ubica = 0, $adquisicion = 0, $role = 0;

    public function render()
    {
        return view('livewire.exportar-equipo');
    }
}
