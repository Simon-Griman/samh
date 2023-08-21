<?php

namespace App\Http\Livewire\User;

use App\Models\Equipo;
use App\Models\Rolequipo;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public $nombre, $email, $cedula, $borrar, $user_borrar;

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
        $users = User::where('name', 'LIKE', '%' . $this->nombre . '%')
            ->where('email', 'LIKE', '%' . $this->email . '%')
            ->where('cedula', 'LIKE', $this->cedula . '%')
            ->paginate()
        ;

        return view('livewire.user.index', compact('users'));
    }
}
