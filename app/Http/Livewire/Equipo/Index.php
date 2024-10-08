<?php

namespace App\Http\Livewire\Equipo;

use App\Models\Biendependiente;
use App\Models\Departamento;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Rolequipo;
use App\Models\Tipoequipo;
use App\Models\Ubicacion;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $tipo, $marca, $modelo, $serial, $bien_nacional, $rol, $departamento, $usuario, $ubicacion, $nombre, $marca_id, $id_marca, $modelo_id, $serial_dependiente, $bien_dependiente;

    public $borrar, $bn_borrar;

    protected $paginationTheme = "bootstrap";

    protected $rules = [
        'nombre' => 'required',
        'marca_id' => 'required',
        'modelo_id' => 'nullable',
        'serial_dependiente' => 'nullable|min:5|unique:biendependientes,serial',
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

    public function updatingRol()
    {
        $this->resetPage();
    }

    public function updatingDepartamento()
    {
        $this->resetPage();
    }

    public function updatingUsuario()
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

        $rol = Rolequipo::where('rol', 'Dañado')->first();

        $equipo->update([
            'departamento_id' => null,
            'user_id' => null,
            'desincorporacion' => '1',
            'borrado' => $user,
            'rolequipo_id' => $rol->id,
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

        if (empty($this->modelo_id))
        {
            $this->modelo_id = null;
        }

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
        $equipos = Equipo::select('equipos.id', 'tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'modelos.id as id_modelo', 'modelos.nombre as modelo', 'serial', 'bien_nacional', 'rolequipos.id as id_rol', 'rol', 'departamentos.id as id_departamento', 'departamentos.nombre as departamento', 'users.id as id_user', 'name', 'observacion', 'creado', 'actualizado', 'ubicacions.nombre as ubicacion', 'fecha_adquisicion', 'depreciacion')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
            ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
            ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
            ->join('departamentos', 'departamentos.id', '=', 'equipos.departamento_id')
            ->join('users', 'users.id', '=', 'equipos.user_id')
            ->join('ubicacions', 'ubicacions.id', '=', 'users.ubicacion_id')
            ->where('tipoequipos.nombre', 'LIKE', '%' . $this->tipo . '%')
            ->where('marcas.nombre', 'LIKE', '%' . $this->marca . '%')
            ->where('modelos.nombre', 'LIKE', '%' . $this->modelo . '%')
            ->where('serial', 'LIKE', '%' . $this->serial . '%')
            ->where('bien_nacional', 'LIKE', '%' . $this->bien_nacional . '%')
            ->where('rol', 'LIKE', '%' . $this->rol . '%')
            ->where('departamentos.nombre', 'LIKE', '%' . $this->departamento . '%')
            ->where('name', 'LIKE', '%' . $this->usuario . '%')
            ->where('ubicacions.nombre', 'LIKE', '%' . $this->ubicacion . '%')
            ->orderBy('equipos.updated_at', 'desc')
            ->paginate()
        ;

        $tipos = Tipoequipo::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();
        $roles = Rolequipo::all();
        $departamentos = Departamento::all();
        $usuarios = User::select('name')->orderBy('name')->get();
        $ubicaciones = Ubicacion::all();

        return view('livewire.equipo.index', compact('equipos', 'tipos', 'marcas', 'modelos', 'roles', 'departamentos', 'usuarios', 'ubicaciones'));
    }
}
