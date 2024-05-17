<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    protected $fillable = [
        'descripcion',
        'tipo_unidad',
        'entrada',
        'fecha_entrada',
        'salida',
        'fecha_salida',
        'cantidad',
    ];

    protected function casts(): array
    {
        return [
            'fecha_entrada' => 'datetime',
            'fecha_salida' => 'datetime'
        ];
    }
}
