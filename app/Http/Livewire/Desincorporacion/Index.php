<?php

namespace App\Http\Livewire\Desincorporacion;

use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Rolequipo;
use App\Models\Tipoequipo;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $tipo, $marca, $modelo, $serial, $bien_nacional, $reincorporar, $bn_reincorporar;

    public $borrar, $bn_borrar;

    protected $paginationTheme = "bootstrap";

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
        Equipo::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function borrarTodo()
    {
        $equipos = Equipo::where('desincorporacion', '1');

        if ($equipos->count())
        {
            $equipos->delete();

            $this->dispatchBrowserEvent('borrarTodo');
        }

        else
        {
            $this->dispatchBrowserEvent('sinRegistros');
        }
    }

    public function confirReincorporar($id)
    {
        $this->reincorporar = $id;
        $this->bn_reincorporar = Equipo::find($id)->bien_nacional;
    }

    public function reincorporar()
    {
        $equipo = Equipo::find($this->reincorporar);

        $rolequipos = Rolequipo::all();

        $id_rol = 0;

        foreach ($rolequipos as $rolequipo)
        {
            if ($rolequipo->rol == "Disponible")
            {
                $id_rol = $rolequipo->id;
                break;
            }
        }

        $equipo->update([
            'rolequipo_id' => $id_rol,
            'desincorporacion' => '0',
        ]);

        $this->dispatchBrowserEvent('editar');
    }

    public function render()
    {
        $equipos = Equipo::select('equipos.id', 'tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'modelos.id as id_modelo', 'modelos.nombre as modelo', 'serial', 'bien_nacional', 'rolequipos.id as id_rol', 'borrado')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
            ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
            ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
            ->whereNull('equipos.departamento_id')
            ->whereNull('user_id')
            ->where('desincorporacion', '1')
            ->where('tipoequipos.nombre', 'LIKE', '%' . $this->tipo . '%')
            ->where('marcas.nombre', 'LIKE', '%' . $this->marca . '%')
            ->where('modelos.nombre', 'LIKE', '%' . $this->modelo . '%')
            ->where('serial', 'LIKE', '%' . $this->serial . '%')
            ->where('bien_nacional', 'LIKE', '%' . $this->bien_nacional . '%')
            ->get()
        ;

        $tipos = Tipoequipo::all();
        $marcas = Marca::all();
        $modelos = Modelo::all();

        return view('livewire.desincorporacion.index', compact('equipos', 'tipos', 'marcas', 'modelos'));
    }
}
