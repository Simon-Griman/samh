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
        Tipoequipo::create(['nombre' => 'Computadora']);
        Tipoequipo::create(['nombre' => 'Monitor']);
        Tipoequipo::create(['nombre' => 'Teclado']);
    }
}
