<?php

namespace App\Http\Livewire\Cintillo;

use App\Models\Cintillo;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $cintillo, $cintillo_borrar, $borrar, $cintillo_activar, $activar, $title, $cintillo_title;

    protected $rules = [
        'cintillo' => 'required|image|mimes:jpeg,jpg|max:2048',
        'title' => 'required|unique:cintillos,title'
    ];

    public function up()
    {
        $this->validate();

        $nombre = $this->cintillo->store('profile-photos', 'public');

        Cintillo::create([
            'nombre' => $nombre,
            'title' => $this->title,
        ]);

        $this->dispatchBrowserEvent('crear');

        $this->reset('cintillo');
    }

    public function modalActivar($id)
    {
        $this->activar = $id;
        $this->cintillo_activar = Cintillo::find($id)->title;
    }

    public function activar()
    {
        Cintillo::where('activo', 2)->update(['activo' => '1']);

        $cintillo = Cintillo::find($this->activar);

        $cintillo->update(['activo' => '2']);

        $this->dispatchBrowserEvent('editar');
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->cintillo_borrar = Cintillo::find($id)->nombre;
        $this->cintillo_title = Cintillo::find($id)->title;
    }

    public function borrar()
    {
        $cintillo = Cintillo::find($this->borrar);

        if ($cintillo->activo == 2)
        {
            $this->dispatchBrowserEvent('borrar_activo');
        }

        else
        {
            Storage::disk('public')->delete($this->cintillo_borrar);

            $cintillo->delete();
        
            $this->dispatchBrowserEvent('borrar');
        }
    }

    public function render()
    {
        $cintillos = Cintillo::all();

        return view('livewire.cintillo.index', compact('cintillos'));
    }
}
