<?php

namespace Database\Seeders;

use App\Models\Rolequipo;
use Illuminate\Database\Seeder;

class RolequipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rolequipo::create(['rol' => 'Dañado']);
        Rolequipo::create(['rol' => 'En Uso']);
    }
}
