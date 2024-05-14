<?php

namespace App\Http\Livewire\Inventario;

use App\Models\Biendependiente;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Tipoequipo;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $tipo, $marca, $marca_id, $id_marca, $modelo, $modelo_id, $serial, $bien_nacional, $nombre, $serial_dependiente, $bien_dependiente;

    public $borrar, $bn_borrar;

    protected $paginationTheme = "bootstrap";

    protected $rules = [
        'nombre' => 'required',
        'marca_id' => 'required',
        'modelo_id' => 'nullable',
        'serial_dependiente' => 'required|min:5|unique:biendependientes,serial',
    ];

    public function updatingTipo()
    {
        $this->resetPage();
    }

    public function updatingMarca()
    {
        $this->resetPage();
    }

    public function updatingModelo()
    {
        $this->resetPage();
    }

    public function updatingSerial()
    {
        $this->resetPage();
    }

    public function updatingBien_nacional()
    {
        $this->resetPage();
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->bn_borrar = Equipo::find($id)->bien_nacional;
    }

    public function borrar()
    {
        $equipo = Equipo::find($this->borrar);

        $user = Auth::User()->name;

        $equipo->update([
            'desincorporacion' => '1',
            'borrado' => $user,
        ]);
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function limpiarCampos()
    {
        $this->nombre = '';
        $this->marca_id = $this->id_marca;
        $this->serial_dependiente = '';
        $this->modelo_id = '';
    }

    public function agregar($id, $id_marca=2)
    {
        $this->id_marca = $id_marca;
        $this->limpiarCampos();
        $this->bien_dependiente = $id;        
    }

    public function crear()
    {
        $this->validate();

        Biendependiente::create([
            'nombre' => $this->nombre,
            'marca_id' => $this->marca_id,
            'modelo_id' => $this->modelo_id,
            'bien_nacional_id' => $this->bien_dependiente,
            'serial' => $this->serial_dependiente,
        ]);

        $this->dispatchBrowserEvent('crear');
    }

    public function render()
    {
        $equipos = Equipo::select('equipos.id', 'tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'modelos.id as id_modelo', 'modelos.nombre as modelo', 'serial', 'bien_nacional', 'rolequipos.id as id_rol', 'creado', 'actualizado')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
            ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
            ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
            ->whereNull('equipos.departamento_id')
            ->whereNull('user_id')
            ->where('rolequipos.rol', 'Disponible')
            ->where('desincorporacion', '0')
            ->where('tipoequipos.nombre', 'LIKE', '%' . $this->tipo . '%')
            ->where('marcas.nombre', 'LIKE', '%' . $this->marca . '%')
            ->where('modelos.nombre', 'LIKE', '%' . $this->modelo . '%')
            ->where('serial', 'LIKE', '%' . $this->serial . '%')
            ->where('bien_nacional', 'LIKE', '%' . $this->bien_nacional . '%')
            ->paginate()
        ;

        $tipos = Tipoequipo::all();
        $marcas = Marca::all();
        $modelos = Modelo::orderBy('nombre')->get();

        return view('livewire.inventario.index', compact('equipos', 'tipos', 'marcas', 'modelos'));
    }
}
