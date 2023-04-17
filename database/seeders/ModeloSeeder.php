<?php

namespace Database\Seeders;

use App\Models\Modelo;
use Illuminate\Database\Seeder;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Modelo::create(['nombre' => 'hp-550', 'marca_id' => '1']);
        Modelo::create(['nombre' => 'hp-1100', 'marca_id' => '1']);
        Modelo::create(['nombre' => 'dew7fa', 'marca_id' => '2']);
        Modelo::create(['nombre' => 'vit-123', 'marca_id' => '3']);
    }
}
