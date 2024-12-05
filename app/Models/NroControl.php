<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NroControl extends Model
{
    use HasFactory;

    protected $fillable = [
        'entrada',
        'salida',
        'entrega',
    ];
}
