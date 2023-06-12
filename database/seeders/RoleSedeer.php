<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super-Admin']);
        $rolAdmin = Role::create(['name' => 'Admin']);
        $rolBN = Role::create(['name' => 'Bien-Nacional']);
        $rolJefe = Role::create(['name' => 'Jefe']);
        $rolStandar = Role::create(['name' => 'Standar']);

        Permission::create(['name' => 'equipos.index'])->syncRoles([$rolAdmin, $rolBN]);
        Permission::create(['name' => 'equipos.create'])->syncRoles([$rolAdmin, $rolBN]);
        Permission::create(['name' => 'equipos.edit'])->syncRoles([$rolAdmin, $rolBN]);
        Permission::create(['name' => 'equipos.delete'])->syncRoles([$rolAdmin, $rolBN]);

        Permission::create(['name' => 'inventario.index'])->syncRoles([$rolAdmin, $rolBN]);
        Permission::create(['name' => 'inventario.create'])->syncRoles([$rolAdmin, $rolBN]);
        Permission::create(['name' => 'inventario.edit'])->syncRoles([$rolAdmin, $rolBN]);
        Permission::create(['name' => 'inventario.delete'])->syncRoles([$rolAdmin, $rolBN]);

        Permission::create(['name' => 'mis_equipos'])->syncRoles([$rolAdmin, $rolStandar, $rolJefe]);

        Permission::create(['name' => 'solicitar'])->syncRoles([$rolAdmin, $rolJefe]);

        Permission::create(['name' => 'solicitudes'])->syncRoles([$rolAdmin, $rolJefe]);

        Permission::create(['name' => 'nombre_equipos.index'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'nombre_equipos.create'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'nombre_equipos.edit'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'nombre_equipos.delete'])->syncRoles([$rolAdmin]);

        Permission::create(['name' => 'users.index'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'users.create'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'users.edit'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'users.delete'])->syncRoles([$rolAdmin]);

        Permission::create(['name' => 'roles.index'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'roles.create'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'roles.edit'])->syncRoles([$rolAdmin]);
        Permission::create(['name' => 'roles.delete'])->syncRoles([$rolAdmin]);
    }
}
