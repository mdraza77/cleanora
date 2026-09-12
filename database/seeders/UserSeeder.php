<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Define dummy users for each role
        $users = [
            [
                'name' => 'Md Raza',
                'email' => 'admin@gmail.com',
                'role' => 'Super Admin',
            ],
            [
                'name' => 'Amir Alam',
                'email' => 'sameer72135@gmail.com',
                'role' => 'Admin',
            ],
            [
                'name' => 'Taksin Raja',
                'email' => 'taskinraja01@gmail.com',
                'role' => 'Customer',
            ],
            [
                'name' => 'Mubarak Ali',
                'email' => 'mubarak01@gmail.com',
                'role' => 'Customer',
            ],
            [
                'name' => 'Aman Raja',
                'email' => 'amanraja05010501@gmail.com',
                'role' => 'Customer',
            ],
            [
                'name' => 'Arjun Das',
                'email' => 'arjun.das@example.com',
                'role' => 'Customer',
            ],
            [
                'name' => 'Rohit Sharma',
                'email' => 'rohit.sharma@example.com',
                'role' => 'Customer',
            ],
            [
                'name' => 'Sneha Roy',
                'email' => 'sneha.roy@example.com',
                'role' => 'Customer',
            ],
            [
                'name' => 'Rahul Das',
                'email' => 'rahul.das@example.com',
                'role' => 'Cleaner',
            ],
            [
                'name' => 'Priya Sharma',
                'email' => 'priya.sharma@example.com',
                'role' => 'Cleaner',
            ],
            [
                'name' => 'Sanjay Roy',
                'email' => 'sanjay.roy@example.com',
                'role' => 'Cleaner',
            ],
            [
                'name' => 'Neha Kumari',
                'email' => 'neha.kumari@example.com',
                'role' => 'Cleaner',
            ],
        ];

        // 4. Create or Update Users and Assign Roles
        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('Raza@Cleanora'),
                ]
            );
            $user->syncRoles([$userData['role']]);
        }
    }
}
