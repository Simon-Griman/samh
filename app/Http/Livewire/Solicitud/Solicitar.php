<?php

namespace App\Http\Livewire\Solicitud;

use App\Models\Solicitud;
use App\Models\Tipoequipo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Solicitar extends Component
{
    public $tipo_equipo, $destinatario;

    public function equipo($id)
    {
        $this->tipo_equipo = $id;
    }

    public function create()
    {
        $user = Auth::User()->id;

        Solicitud::create([
            'equipo_id' => $this->tipo_equipo,
            'destinatario_id' => $this->destinatario,
            'user_id' => $user,
        ]);

        $this->dispatchBrowserEvent('solicitar');
    }

    public function render()
    {
        $equipos = Tipoequipo::all();

        $users = User::all();

        return view('livewire.solicitud.solicitar', compact('equipos', 'users'));
    }
}
