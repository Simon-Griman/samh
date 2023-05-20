<?php

namespace App\Http\Livewire\Inventario;

use Livewire\Component;

class Edit extends Component
{
    public $equipo;

    public function render()
    {
        return view('livewire.inventario.edit');
    }
}
