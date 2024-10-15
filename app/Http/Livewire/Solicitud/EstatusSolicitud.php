<?php

namespace App\Http\Livewire\Solicitud;

use App\Models\Solicitud;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class EstatusSolicitud extends Component
{
    public function render()
    {
        $user = Auth::User()->id;

        $misSolicitudes = Solicitud::select('tipoequipos.nombre as equipo', 'users.name as destinatario', 'estado')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'solicituds.equipo_id')
            ->join('users', 'users.id', '=', 'solicituds.destinatario_id')
            ->where('user_id', $user)
            ->orderBy('solicituds.created_at', 'desc')
            ->get()
        ;

        return view('livewire.solicitud.estatus-solicitud', compact('misSolicitudes'));
    }
}
