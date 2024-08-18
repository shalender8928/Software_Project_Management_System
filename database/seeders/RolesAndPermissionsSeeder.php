<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'add employee',
            'edit employee',
            'view projects',
            'generate reports',
            'edit category',
            'delete category',
            'view category',
            'add category',
            'delete employee',
            'view employee detail',
            'assign category',
            'update assigned category',
            'add role',
            'edit role',
            'delete role',
            'view role',
            'assign role',
            'update assigned role',
            'add permission',
            'edit permission',
            'delete permission',
            'view permission',
            'assign permission',
            'add qualification',
            'edit qualification',
            'delete qualification',
            'view qualification',
            'assign qualification',
            'add project',
            'edit project',
            'delete project',
            'view project',
            'add task',
            'edit task',
            'delete task',
            'view task',
            'assign task',
            'update assigned task',
            'add project plan',
            'edit project plan',
            'delete project plan'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create Admin role and assign only 'assign permission'
        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo('assign permission');
    }
}
