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
                'country_code' => '+91',
                'phone' => '9876543210',
            ],
            [
                'name' => 'Amir Alam',
                'email' => 'sameer72135@gmail.com',
                'role' => 'Admin',
                'country_code' => '+91',
                'phone' => '9876501234',
            ],
            [
                'name' => 'Taksin Raja',
                'email' => 'taskinraja01@gmail.com',
                'role' => 'Customer',
                'country_code' => '+91',
                'phone' => '9123456780',
            ],
            [
                'name' => 'Mubarak Ali',
                'email' => 'mubarak01@gmail.com',
                'role' => 'Customer',
                'country_code' => '+91',
                'phone' => '9988776655',
            ],
            [
                'name' => 'Aman Raja',
                'email' => 'amanraja05010501@gmail.com',
                'role' => 'Customer',
                'country_code' => '+91',
                'phone' => '9765432109',
            ],
            [
                'name' => 'Arjun Das',
                'email' => 'arjun.das@example.com',
                'role' => 'Customer',
                'country_code' => '+91',
                'phone' => '9012345678',
            ],
            [
                'name' => 'Rohit Sharma',
                'email' => 'rohit.sharma@example.com',
                'role' => 'Customer',
                'country_code' => '+91',
                'phone' => '8899001122',
            ],
            [
                'name' => 'Sneha Roy',
                'email' => 'sneha.roy@example.com',
                'role' => 'Customer',
                'country_code' => '+91',
                'phone' => '9556677889',
            ],
            [
                'name' => 'Rahul Das',
                'email' => 'rahul.das@example.com',
                'role' => 'Cleaner',
                'country_code' => '+91',
                'phone' => '9332211000',
            ],
            [
                'name' => 'Priya Sharma',
                'email' => 'priya.sharma@example.com',
                'role' => 'Cleaner',
                'country_code' => '+91',
                'phone' => '9445566778',
            ],
            [
                'name' => 'Sanjay Roy',
                'email' => 'sanjay.roy@example.com',
                'role' => 'Cleaner',
                'country_code' => '+91',
                'phone' => '9667788990',
            ],
            [
                'name' => 'Neha Kumari',
                'email' => 'neha.kumari@example.com',
                'role' => 'Cleaner',
                'country_code' => '+91',
                'phone' => '9778899001',
            ],
        ];

        // 2. Hash the password only once
        $hashedPassword = Hash::make('Raza@Cleanora');

        // 3. Create or Update Users and Assign Roles
        foreach ($users as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name'         => $userData['name'],
                    'country_code' => $userData['country_code'],
                    'phone'        => $userData['phone'],
                    'password'     => $hashedPassword,
                ]
            );

            // Only sync role if needed
            if (!$user->hasRole($userData['role'])) {
                $user->syncRoles([$userData['role']]);
            }
        }
    }
}
