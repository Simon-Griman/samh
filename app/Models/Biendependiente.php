<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biendependiente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'marca_id',
        'modelo_id',
        'bien_nacional_id',
        'serial',
    ];
}
