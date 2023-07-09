<?php

namespace App\Http\Livewire\Solicitud;

use App\Models\Departamento;
use App\Models\Equipo;
use App\Models\Rolequipo;
use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Solicitudes extends Component
{
    public function asignar($id, $id_user, $id_solicitud)
    {
        $disponibilidad = Equipo::select('tipoequipos.nombre', 'equipos.id')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
            ->where('rolequipos.rol', 'Disponible')
            ->where('tipoequipos.id', $id)   
        ;

        if ($disponibilidad->count())
        {   
            $cantidad = $disponibilidad->count();
            
            $id_equipo = $disponibilidad->first()->id;

            $equipo = Equipo::find($id_equipo);

            $rol_disponible = Rolequipo::where('rol', 'En Uso')->first()->id;

            $departamento = User::find($id_user)->departamento_id;

            $equipo->update([
                'rolequipo_id' => $rol_disponible,
                'user_id' => $id_user,
                'departamento_id' => $departamento,
            ]);

            if ($cantidad > $disponibilidad->count())
            {
                $solicitud = Solicitud::find($id_solicitud);

                $solicitud->update([
                    'estado' => 2
                ]);

                $this->dispatchBrowserEvent('aceptado');
            }
        }

        else
        {
            $this->dispatchBrowserEvent('vacio');
        }
    }

    public function rechazar($id)
    {
        $solicitud = Solicitud::find($id);

        $solicitud->update([
            'estado' => 3
        ]);

        $this->dispatchBrowserEvent('rechazado');
    }

    //Los jefes solo deben ver las solicitudes de su departamento

    public function render()
    {
        $solicitudes = Solicitud::select('solicituds.id', 'tipoequipos.nombre as equipo', 'tipoequipos.id as id_equipo', 'users.name as user', 'users.id as id_user', 'users.departamento_id', 'estado')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'solicituds.equipo_id')
            ->join('users', 'users.id', '=', 'solicituds.destinatario_id')
            ->orderBy('solicituds.created_at', 'desc')                
            ->get()
        ;

        $solicitante = Solicitud::select('users.name as solicitante', 'solicituds.id')
            ->join('users', 'users.id', '=', 'solicituds.user_id')
            ->get()    
        ;

        $departamento = Auth::User()->departamento_id;

        return view('livewire.solicitud.solicitudes', compact('solicitudes', 'solicitante', 'departamento'));
    }
}
