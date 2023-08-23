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
        Departamento::create(['nombre' => 'Dirección General']);
        Departamento::create(['nombre' => 'Direccción de Tecnología e Información']);
        Departamento::create(['nombre' => 'Planificación, Presupuesto y Organización']);
        Departamento::create(['nombre' => 'Dirección de Asesoría Legal']);
        Departamento::create(['nombre' => 'Dirección de Evaluación y Certificación']);
        Departamento::create(['nombre' => 'Dirección de Medición Fiscal']);
        Departamento::create(['nombre' => 'División de Recursos Humanos']);
        Departamento::create(['nombre' => 'División de Administración y Servicios']);
        Departamento::create(['nombre' => 'Estudios y Prácticas Sociopoliticas']);
    }
}
