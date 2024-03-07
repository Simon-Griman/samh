<?php

namespace Database\Seeders;

use App\Models\Ubicaion;
use Illuminate\Database\Seeder;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ubicacion::create(['nombre' => 'Maracaibo']);
    }
}
