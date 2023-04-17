<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Simón Grimán', 
            'email' => 'simongrimanv@hotmail.com', 
            'cedula' => '26716044',
            'password' => bcrypt('simonG20'),
            'departamento_id' => '1',
        ])->assignRole('Super-Admin'); //un solo rol
    }
}
