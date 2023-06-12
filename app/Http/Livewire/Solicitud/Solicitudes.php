<?php

namespace App\Http\Livewire\Solicitud;

use App\Models\Solicitud;
use Livewire\Component;

class Solicitudes extends Component
{
    public function render()
    {
        $solicitudes = Solicitud::select('solicituds.id', 'tipoequipos.nombre as equipo', 'users.name as user')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'solicituds.equipo_id')
            ->join('users', 'users.id', '=', 'solicituds.user_id')    
            ->get()
        ;

        $destinatario = Solicitud::select('users.name as destinatario', 'solicituds.id')
            ->join('users', 'users.id', '=', 'solicituds.destinatario_id')
            ->get()    
        ;

        return view('livewire.solicitud.solicitudes', compact('solicitudes', 'destinatario'));
    }
}
