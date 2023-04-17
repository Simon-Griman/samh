<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public $nombre, $email, $cedula;

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
