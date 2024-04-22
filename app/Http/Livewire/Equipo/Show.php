<?php

namespace App\Http\Livewire\Equipo;

use App\Models\Departamento;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Rolequipo;
use App\Models\Tipoequipo;
use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $equipo;

    public $tipo, $marca, $modelo, $serial, $bien_nacional, $rol, $observacion, $departamento, $usuario, $creado;

    public function mount()
    {
        $this->tipo = $this->equipo->id_tipo;
        $this->marca = $this->equipo->id_marca;
        $this->modelo = $this->equipo->id_modelo;
        $this->serial = $this->equipo->serial;
        $this->bien_nacional = $this->equipo->bien_nacional;
        $this->rol = $this->equipo->id_rol;
        $this->observacion = $this->equipo->observacion;
        $this->departamento = $this->equipo->id_departamento;
        $this->usuario = $this->equipo->id_user;
        $this->creado = $this->equipo->creado;
    }

    public function render()
    {
        $equipos = Tipoequipo::find($this->tipo)->nombre;
        $marcas = Marca::find($this->marca)->nombre;
        $modelos = Modelo::find($this->modelo)->nombre;
        $roles = Rolequipo::find($this->rol)->rol;
        $departamentos = Departamento::find($this->departamento)->nombre;
        $usuarios = User::find($this->usuario)->name;

        return view('livewire.equipo.show', compact('equipos', 'marcas', 'modelos', 'roles', 'departamentos', 'usuarios'));
    }
}
