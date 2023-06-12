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

        $myuser = Auth::User();

        $rolUsers = $myuser->getRoleNames();

        foreach($rolUsers as $rolUser)
        {
            if ($rolUser == 'Super-Admin')
            {
                $users = User::all();
                break;
            }
            elseif ($rolUser == 'Admin')
            {
                $users = User::all();
                break;
            }
            elseif ($rolUser == 'Jefe')
            {
                $users = User::where('departamento_id', $myuser->departamento_id)->get();
                break;
            }
        }

        return view('livewire.solicitud.solicitar', compact('equipos', 'users'));
    }
}