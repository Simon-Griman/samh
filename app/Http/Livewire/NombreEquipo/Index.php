<?php

namespace App\Http\Livewire\NombreEquipo;

use App\Models\Departamento;
use App\Models\Tipoequipo;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Index extends Component
{
    public $borrar, $equipo_borrar, $crear = true, $equipo, $id_equipo, $departamento, $depreciacion;

    protected function rules()
    {
        return [
            'equipo' => ['required', Rule::unique('tipoequipos', 'nombre')->ignore($this->id_equipo)],
            'departamento' => 'required',
            'depreciacion' => 'nullable|integer'
        ];
    }

    public function modalCrear()
    {
        $this->crear = true;
        $this->limpiarCampos();
    }

    public function crear()
    {
        $this->validate();

        if (empty($this->depreciacion))
        {
            $this->depreciacion = null;
        }

        Tipoequipo::create([
            'nombre' => $this->equipo,
            'departamento_id' => $this->departamento,
            'depreciacion' => $this->depreciacion
        ]);
        $this->limpiarCampos();
        $this->dispatchBrowserEvent('crear');
    }

    public function modalEditar($id)
    {
        $this->crear = false;

        $equipo = Tipoequipo::findOrFail($id);

        $this->id_equipo = $id;
        $this->equipo = $equipo->nombre;
        $this->departamento = $equipo->departamento_id;
        $this->depreciacion = $equipo->depreciacion;
    }

    public function editar()
    {
        $this->validate();

        $equipo = Tipoequipo::find($this->id_equipo);

        if (empty($this->depreciacion))
        {
            $this->depreciacion = null;
        }

        $equipo->update([
            'nombre' => $this->equipo,
            'departamento_id' => $this->departamento,
            'depreciacion' => $this->depreciacion
        ]);

        $this->limpiarCampos();

        $this->dispatchBrowserEvent('editar');
    }

    public function limpiarCampos()
    {
        $this->id_equipo = '';
        $this->equipo = '';
        $this->departamento = '';
        $this->depreciacion = '';
    }

    public function confirBorrar($id)
    {
        $this->borrar = $id;
        $this->equipo_borrar = Tipoequipo::find($id)->nombre;
    }

    public function borrar()
    {
        Tipoequipo::find($this->borrar)->delete();
        
        $this->dispatchBrowserEvent('borrar');
    }

    public function render()
    {
        $equipos = Tipoequipo::select('tipoequipos.id', 'tipoequipos.nombre', 'departamentos.nombre as departamento', 'tipoequipos.depreciacion')
            ->join('departamentos', 'departamentos.id', '=', 'tipoequipos.departamento_id')
            ->orderBy('tipoequipos.nombre')
            ->get()
        ;

        $departamentos = Departamento::all();

        return view('livewire.nombre-equipo.index', compact('equipos', 'departamentos'));
    }
}
