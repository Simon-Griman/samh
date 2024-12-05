<?php

namespace App\Http\Livewire\Nota;

use App\Models\Equipo;
use App\Models\Tipoequipo;
use App\Models\User;
use Livewire\Component;

class Entrega extends Component
{
    public $usuario = '', $equipos_user, $observacion = '';

    public $equipos = [];
    public $box = [];
    public $selecciones = [];

    protected $rules = [
        'usuario' => 'required',
        'box' => 'required|array|min:1',
    ];

    protected function messages() 
    { 
        return [
            'usuario' => 'El usuario es requerido',
            'box.required' => 'Debe seleccionar al menos una opción.'
        ];
    }

    public function updatedUsuario($value)
    {
        $user = $this->usuario;

        $this->equipos_user = Equipo::select('tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'users.id as id_user', 'name')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('users', 'users.id', '=', 'equipos.user_id')
            ->where('users.id', $user)
            ->get()
        ;

        $this->usuario = $value;

        foreach ($this->equipos_user as $equipo)
        {
            $this->equipos[] = $equipo->equipo;
        }
    }

    public function enviar()
    {
        $this->validate();

        $this->selecciones = [];

        foreach($this->box as $key => $value)
        {
            if($value)
            {
                $this->selecciones[] = $value;
            }
        }

        return redirect()->route('entrega.pdf', ['selecciones' => json_encode($this->selecciones), 'user_id' => $this->usuario, 'observacion' => $this->observacion]);
    }

    public function render()
    {
        $users = User::orderBy('name')->get();
        $bienes = Tipoequipo::where('departamento_id', 2)->orderBy('nombre')->get();
        $num1 = 1;
        $num2 = 1;
        $match = false;

        return view('livewire.nota.entrega', compact('users', 'bienes', 'num1', 'num2', 'match'));
    }
}
