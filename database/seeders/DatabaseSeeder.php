<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create roles if they do not exist
        $roles = ['Admin', 'Senior Manager', 'Project Manager', 'Developer', 'Customer'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Create users and assign roles
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'firstname' => 'Admin',
                'lastname' => 'User',
                'password' => Hash::make('password'),
            ]
        );
        $admin_role = Role::where(['name' => 'Admin'])->first();
        if ($admin_role) {
            $admin->assignRole([$admin_role->id]);
        }

        $seniorManager = User::firstOrCreate(
            ['email' => 'seniormanager@gmail.com'],
            [
                'firstname' => 'Senior',
                'lastname' => 'Manager User',
                'password' => Hash::make('12345678'),
            ]
        );
        $seniorManager_role = Role::where(['name' => 'Senior Manager'])->first();
        if ($seniorManager_role) {
            $seniorManager->assignRole([$seniorManager_role->id]);
        }

        $projectManager = User::firstOrCreate(
            ['email' => 'projectmanager@gmail.com'],
            [
                'firstname' => 'Project',
                'lastname' => 'Manager User',
                'password' => Hash::make('12345678'),
            ]
        );
        $projectManager_role = Role::where(['name' => 'Project Manager'])->first();
        if ($projectManager_role) {
            $projectManager->assignRole([$projectManager_role->id]);
        }

        $developer = User::firstOrCreate(
            ['email' => 'developer@gmail.com'],
            [
                'firstname' => 'Developer',
                'lastname' => 'User',
                'password' => Hash::make('12345678'),
            ]
        );
        $developer_role = Role::where(['name' => 'Developer'])->first();
        if ($developer_role) {
            $developer->assignRole([$developer_role->id]);
        }

        $customer = User::firstOrCreate(
            ['email' => 'customer@gmail.com'],
            [
                'firstname' => 'Customer',
                'lastname' => 'User',
                'password' => Hash::make('12345678'),
            ]
        );
        $customer_role = Role::where(['name' => 'Customer'])->first();
        if ($customer_role) {
            $customer->assignRole([$customer_role->id]);
        }
    }
}