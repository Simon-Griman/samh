<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;

    protected $fillable = [
        'articulo_id',
        'tipo_unidad',
        'entrada',
        'fecha_entrada',
        'salida',
        'fecha_salida',
    ];

    protected function casts(): array
    {
        return [
            'fecha_entrada' => 'datetime',
            'fecha_salida' => 'datetime'
        ];
    }
}
