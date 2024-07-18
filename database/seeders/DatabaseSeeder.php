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
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('Admin');

        $seniorManager = User::firstOrCreate(
            ['email' => 'seniormanager@gmail.com'],
            [
                'name' => 'Senior Manager User',
                'password' => Hash::make('12345678'),
            ]
        );
        $seniorManager->assignRole('Senior Manager');

        $projectManager = User::firstOrCreate(
            ['email' => 'projectmanager@gmail.com'],
            [
                'name' => 'Project Manager User',
                'password' => Hash::make('12345678'),
            ]
        );
        $projectManager->assignRole('Project Manager');

        $developer = User::firstOrCreate(
            ['email' => 'developer@gmail.com'],
            [
                'name' => 'Developer User',
                'password' => Hash::make('12345678'),
            ]
        );
        $developer->assignRole('Developer');

        $customer = User::firstOrCreate(
            ['email' => 'customer@gmail.com'],
            [
                'name' => 'Customer User',
                'password' => Hash::make('12345678'),
            ]
        );
        $customer->assignRole('Customer');
    }
}