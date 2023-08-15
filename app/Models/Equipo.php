<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipoequipo_id',
        'marca_id',
        'modelo_id',
        'serial',
        'bien_nacional',
        'rolequipo_id',
        'observacion',
        'departamento_id',
        'user_id',
        'desincorporacion',
        'creado',
        'actualizado',
    ];
}
