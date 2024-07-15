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

        // create permissions
        Permission::create(['name' => 'add employee']);
        Permission::create(['name' => 'edit employee']);
        Permission::create(['name' => 'update employee status']);
        Permission::create(['name' => 'delete employee']);
        Permission::create(['name' => 'view projects']);
        Permission::create(['name' => 'edit projects']);
        Permission::create(['name' => 'view tasks']);
        Permission::create(['name' => 'edit tasks']);
        Permission::create(['name' => 'view reports']);
        Permission::create(['name' => 'generate reports']);

        // create roles and assign existing permissions
        $adminRole = Role::create(['name' => 'Admin']);
        $adminRole->givePermissionTo(Permission::all());

        $seniorManagerRole = Role::create(['name' => 'Senior Manager']);
        $seniorManagerRole->givePermissionTo([
            'view projects',
            'edit projects',
            'view tasks',
            'edit tasks',
            'view reports',
            'generate reports',
            'add employee',
            'edit employee',
            'update employee status',
        ]);

        $projectManagerRole = Role::create(['name' => 'Project Manager']);
        $projectManagerRole->givePermissionTo([
            'view projects',
            'edit projects',
            'view tasks',
            'edit tasks',
            'view reports',
            'generate reports',
        ]);

        $developerRole = Role::create(['name' => 'Developer']);
        $developerRole->givePermissionTo([
            'view projects',
            'view tasks',
        ]);

        $customerRole = Role::create(['name' => 'Customer']);
        $customerRole->givePermissionTo([
            'view projects',
            'view tasks',
            'view reports',
        ]);
    }
}

