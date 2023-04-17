<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departamento::create(['nombre' => 'OSTI']);
        Departamento::create(['nombre' => 'Administración']);
        Departamento::create(['nombre' => 'Recursos Humanos']);
    }
}
