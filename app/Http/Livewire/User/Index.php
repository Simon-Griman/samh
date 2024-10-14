<?php

namespace App\Http\Livewire\User;

use App\Models\Departamento;
use App\Models\Equipo;
use App\Models\Rolequipo;
use App\Models\Ubicacion;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public $nombre, $email, $cedula, $departamento, $ubicacion, $borrar, $user_borrar;

    protected $paginationTheme = "bootstrap";

    public function updatingNombre()
    {
        $this->resetPage();
    }

    public function updatingEmail()
    {
        $this->resetPage();
    }

    public function updatingCedula()
    {
        $this->resetPage();
    }

    public function updatingDepartamento()
    {
        $this->resetPage();
    }

    public function updatingUbicacion()
    {
        $this->resetPage();
    }
    
    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->user_borrar = User::find($id)->name;
    }

    public function borrar()
    {
        $roles = Rolequipo::all();
        $rol_disponible = '';

        foreach($roles as $rol)
        {
            if($rol->rol == 'Disponible')
            {
                $rol_disponible = $rol->id;
                break;
            }
        }

        $equipos = Equipo::where('user_id', $this->borrar);

        $equipos->update([
            'departamento_id' => null,
            'user_id' => null,
            'rolequipo_id' => $rol_disponible,
        ]);

        User::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $users = User::select('users.id' ,'name', 'email', 'cedula', 'departamentos.nombre as departamento', 'ubicacions.nombre as ubicacion', 'cargos.nombre as cargo')
            ->join('departamentos', 'departamentos.id', '=', 'users.departamento_id')
            ->join('ubicacions', 'ubicacions.id', '=', 'users.ubicacion_id')
            ->leftjoin('cargos', 'cargos.id', '=', 'users.cargo_id')
            ->where('name', 'LIKE', '%' . $this->nombre . '%')
            ->where('email', 'LIKE', '%' . $this->email . '%')
            ->where('cedula', 'LIKE', $this->cedula . '%')
            ->where('departamentos.nombre', 'LIKE', '%' . $this->departamento . '%')
            ->where('ubicacions.nombre', 'LIKE', '%' . $this->ubicacion . '%')
            ->paginate()
        ;

        $departamentos = Departamento::all();
        $ubicaciones = Ubicacion::all();

        return view('livewire.user.index', compact('users', 'departamentos', 'ubicaciones'));
    }
}
