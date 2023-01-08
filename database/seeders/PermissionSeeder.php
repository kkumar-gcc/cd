<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'super-admin',
            'admin',
            'writer',
            'user'
        ];
        $permissions = [
            'create blogs'=> ['super-admin','admin'],
            'view unpublished blogs'=> ['super-admin'],
            'edit all blogs'=> ['super-admin'],
            'edit own blogs'=> ['super-admin','admin'],
            'delete own blogs'=> ['super-admin','admin'],
            'delete all blogs'=> ['super-admin'],
            'create tags'=> ['super-admin','admin'],
            'edit tags'=> ['super-admin'],
            'delete tags'=> ['super-admin'],
            'access tags'=> ['super-admin','admin'],
            'access permissions'=> ['super-admin'],
            'edit permissions'=> ['super-admin'],
            'delete permissions'=> ['super-admin'],
            'create permissions'=> ['super-admin'],
            'assign permissions'=> ['super-admin'],
            'access roles'=> ['super-admin'],
            'create roles'=> ['super-admin'],
            'edit roles'=> ['super-admin'],
            'delete roles'=> ['super-admin'],
            'assign roles'=> ['super-admin'],
            'access role permissions'=> ['super-admin'],
            'access user roles'=> ['super-admin'],
            'access users'=> ['super-admin'],
            'edit users'=> ['super-admin'],
            'delete users'=> ['super-admin'],
        ];
        //create roles
        foreach ($roles as $role) {
            $rolesArray[$role] = Role::create(['name' => $role]);
        }
        //create permissions
        foreach ($permissions as $permission => $authorized_roles) {
            //create permission
            Permission::create(['name' => $permission]);
            //authorize roles to those permissions
            foreach ($authorized_roles as $role) {
                $rolesArray[$role]->givePermissionTo($permission);
            }
        }
    }
}
