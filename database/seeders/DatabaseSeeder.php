<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSedeer::class);
        $this->call(DepartamentoSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MarcaSeeder::class);
        $this->call(ModeloSeeder::class);
        $this->call(TipoequipoSeeder::class);
        $this->call(RolequipoSeeder::class);
    }
}
