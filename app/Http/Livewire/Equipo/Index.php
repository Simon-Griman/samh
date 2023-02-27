<?php

namespace App\Http\Livewire\Equipo;

use Livewire\Component;

class Index extends Component
{
    public $equipos;
    
    public function render()
    {
        return view('livewire.equipo.index');
    }
}
