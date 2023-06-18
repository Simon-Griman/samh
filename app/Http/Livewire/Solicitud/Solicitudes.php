<?php

namespace App\Http\Livewire\Solicitud;

use App\Models\Equipo;
use App\Models\Rolequipo;
use App\Models\Solicitud;
use App\Models\User;
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

                $solicitud->delete();

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

        $solicitud->delete();

        $this->dispatchBrowserEvent('rechazado');
    }

    //NO borrar los registros, sino, crear un campo "estado" en la tabla solicituds
    //Este campo se llenara con tres posibles opciones (en proceso, aceptado, rechazado)
    //De esta forma queda un registro de las acciones y los solicitantes podran ver el estado de su solicitud
    //En la vista de solicitudes solo deben aparecer los equipos con el "estado" "en proceso"
    //(Opcional) Crear un historico de operaciones

    public function render()
    {
        $solicitudes = Solicitud::select('solicituds.id', 'tipoequipos.nombre as equipo', 'tipoequipos.id as id_equipo', 'users.name as user', 'users.id as id_user')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'solicituds.equipo_id')
            ->join('users', 'users.id', '=', 'solicituds.destinatario_id')    
            ->get()
        ;

        $solicitante = Solicitud::select('users.name as solicitante', 'solicituds.id')
            ->join('users', 'users.id', '=', 'solicituds.user_id')
            ->get()    
        ;

        return view('livewire.solicitud.solicitudes', compact('solicitudes', 'solicitante'));
    }
}
