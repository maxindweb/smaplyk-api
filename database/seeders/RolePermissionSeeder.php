<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'article-index']);
        Permission::create(['name' => 'create-article']);
        Permission::create(['name' => 'update-article']);
        Permission::create(['name' => 'delete-article']);
        Permission::create(['name' => 'register-user']);
        Permission::create(['name' => 'create-article']);
        Permission::create(['name' => 'create-article']);
        Permission::create(['name' => 'create-article']);
        Permission::create(['name' => 'create-article']);

        //seed role
        $role  = Role::create(['name' => 'super-admin']);
        $role->
        $role2 = Role::create(['name' => 'writer']);
        // $role3 = Role::creare(['name' => '']) 
    }
}
