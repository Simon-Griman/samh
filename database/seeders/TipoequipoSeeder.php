<?php

namespace Database\Seeders;

use App\Models\Tipoequipo;
use Illuminate\Database\Seeder;

class TipoequipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tipoequipo::create(['nombre' => 'Computadora', 'departamento_id' => '2']);
        Tipoequipo::create(['nombre' => 'Monitor', 'departamento_id' => '2']);
        Tipoequipo::create(['nombre' => 'Teclado', 'departamento_id' => '2']);
    }
}
