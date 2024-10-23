<?php

namespace App\Http\Livewire\Equipo;

use App\Models\Biendependiente;
use App\Models\Equipo;
use App\Models\Marca;
use App\Models\Modelo;
use Carbon\Carbon;
use Livewire\Component;
use tidy;

class Show extends Component
{
    public $equipo, $actualizar, $periferico_actualizar, $borrar, $periferico_borrar, $nombre, $marca_id, $modelo_id, $serial_dependiente, $id_dependiente;

    protected function rules()
    {
        return [
            'nombre' => 'required',
            'marca_id' => 'required',
            'modelo_id' => 'nullable',
            'serial_dependiente' => 'nullable|min:5|unique:biendependientes,serial,' . $this->id_dependiente,
        ];
    }

    public function modalBorrar($id)
    {
        $this->borrar = $id;
        $this->periferico_borrar = Biendependiente::find($id)->nombre;
    }

    public function borrar()
    {
        Biendependiente::find($this->borrar)->delete();

        $this->dispatchBrowserEvent('borrar');
    }

    public function modalEditar($id)
    {
        $this->actualizar = $id;
        $this->periferico_actualizar = Biendependiente::find($id);
        $this->id_dependiente = $id;

        $this->nombre = $this->periferico_actualizar->nombre;
        $this->marca_id = $this->periferico_actualizar->marca_id;
        $this->serial_dependiente = $this->periferico_actualizar->serial;
        $this->modelo_id = $this->periferico_actualizar->modelo_id;
    }

    public function editar()
    {
        $this->validate();

        $this->periferico_actualizar->update([
            'nombre' => $this->nombre,
            'marca_id' => $this->marca_id,
            'modelo_id' => $this->modelo_id,
            'serial' => $this->serial_dependiente,
        ]);

        $this->dispatchBrowserEvent('editar');
    }

    public function render()
    {
        if($datos = Equipo::select('equipos.id', 'tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'modelos.id as id_modelo', 'modelos.nombre as modelo', 'equipos.serial', 'bien_nacional', 'bien_pdvsa', 'bien_menpet', 'rolequipos.rol as rol', 'creado', 'actualizado', 'equipos.created_at as f_creado', 'equipos.updated_at as f_actualizado', 'users.name as usuario', 'ubicacions.nombre as ubicacion', 'observacion', 'departamentos.nombre as departamento', 'fecha_adquisicion', 'tipoequipos.depreciacion', 'proveedors.nombre as proveedor', 'costo_compra')
            ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
            ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
            ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
            ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
            ->join('departamentos', 'departamentos.id', '=', 'equipos.departamento_id')
            ->join('users', 'users.id', '=', 'equipos.user_id')
            ->join('ubicacions', 'ubicacions.id', '=', 'users.ubicacion_id')
            ->join('biendependientes', 'biendependientes.bien_nacional_id', '=', 'equipos.id')
            ->leftjoin('proveedors', 'proveedors.id', '=', 'equipos.proveedor_id')
            ->where('equipos.id', $this->equipo->id)
            ->first()
        )
        {
            $perifericos = true;
            $cont = 1;

            $d_mensual = null;
            $depreciacion = null;
            $d_bolivares = null;
            $precio_actual = null;

            if ($datos->fecha_adquisicion)
            {
                $d_acumulada = Carbon::createFromFormat('Y-m-d', $datos->fecha_adquisicion);
                
                $acumulada = $d_acumulada->diffInDays(now());

                $d_mensual = intdiv($acumulada, 30);
            }

            if ($datos->costo_compra && $datos->depreciacion)
            {
                $depreciacion = ($datos->costo_compra * 0.9) / $datos->depreciacion;

                
                if ($d_mensual !== null)
                {
                    $d_bolivares = $depreciacion * $d_mensual;
                    $precio_actual = $datos->costo_compra - $d_bolivares;
                }
            }

            $dependientes = Biendependiente::select('biendependientes.id as id', 'biendependientes.nombre as nombre', 'marcas.nombre as marca', 'modelos.nombre as modelo', 'biendependientes.serial')
                ->join('marcas', 'marcas.id', '=', 'biendependientes.marca_id')
                ->leftjoin('modelos', 'modelos.id', '=', 'biendependientes.modelo_id')
                ->join('equipos', 'equipos.id', '=', 'biendependientes.bien_nacional_id')
                ->where('equipos.id', $this->equipo->id)
                ->get()
            ;

            $marcas = Marca::orderBy('nombre')->get();
            $modelos = Modelo::orderBy('nombre')->get();

            return view('livewire.equipo.show', compact('datos', 'perifericos', 'dependientes', 'cont', 'd_mensual', 'depreciacion', 'd_bolivares', 'precio_actual', 'marcas', 'modelos'));
        }

        else
        {
            $datos = Equipo::select('equipos.id', 'tipoequipos.id as id_tipo', 'tipoequipos.nombre as equipo', 'marcas.id as id_marca', 'marcas.nombre as marca', 'modelos.id as id_modelo', 'modelos.nombre as modelo', 'equipos.serial', 'bien_nacional', 'bien_pdvsa', 'bien_menpet', 'rolequipos.rol as rol', 'creado', 'actualizado', 'equipos.created_at as f_creado', 'equipos.updated_at as f_actualizado', 'users.name as usuario', 'ubicacions.nombre as ubicacion', 'observacion', 'departamentos.nombre as departamento', 'fecha_adquisicion', 'tipoequipos.depreciacion', 'proveedors.nombre as proveedor', 'costo_compra')
                ->join('tipoequipos', 'tipoequipos.id', '=', 'equipos.tipoequipo_id')
                ->join('marcas', 'marcas.id', '=', 'equipos.marca_id')
                ->join('modelos', 'modelos.id', '=', 'equipos.modelo_id')
                ->join('rolequipos', 'rolequipos.id', '=', 'equipos.rolequipo_id')
                ->join('departamentos', 'departamentos.id', '=', 'equipos.departamento_id')
                ->join('users', 'users.id', '=', 'equipos.user_id')
                ->join('ubicacions', 'ubicacions.id', '=', 'users.ubicacion_id')
                //->join('biendependientes', 'biendependientes.bien_nacional_id', '=', 'equipos.id')
                ->leftjoin('proveedors', 'proveedors.id', '=', 'equipos.proveedor_id')
                ->where('equipos.id', $this->equipo->id)
                ->first()
            ;

            $perifericos = false;

            $d_mensual = null;
            $depreciacion = null;
            $d_bolivares = null;
            $precio_actual = null;

            if ($datos->fecha_adquisicion)
            {
                $d_acumulada = Carbon::createFromFormat('Y-m-d', $datos->fecha_adquisicion);
                
                $acumulada = $d_acumulada->diffInDays(now());

                $d_mensual = intdiv($acumulada, 30);

                if ($d_mensual > $datos->depreciacion)
                {
                    $d_mensual = $datos->depreciacion;
                }

            }

            if ($datos->costo_compra && $datos->depreciacion)
            {
                $depreciacion = ($datos->costo_compra * 0.9) / $datos->depreciacion;

                
                if ($d_mensual !== null)
                {
                    $d_bolivares = $depreciacion * $d_mensual;
                    $precio_actual = $datos->costo_compra - $d_bolivares;
                }
            }

            return view('livewire.equipo.show', compact('datos', 'perifericos', 'd_mensual', 'depreciacion', 'd_bolivares', 'precio_actual'));
        }
    }
}