<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission as ModelsPermission;

class AddPermissionsMilitar extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'militar-list',
            'militar-create',
            'militar-edit',
            'militar-delete',
            'militar-caderneta',
         ];

         foreach ($permissions as $permission) {
            ModelsPermission::create(['name' => $permission]);
       }
    }
}
