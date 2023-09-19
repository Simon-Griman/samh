<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipoequipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'departamento_id'
    ];
}
