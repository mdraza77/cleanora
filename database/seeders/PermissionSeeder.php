<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Cache reset
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // ===== DASHBOARD =====
        Permission::firstOrCreate(['name' => 'Dashboard']);

        // ===== ACCESS MANAGEMENT =====
        Permission::firstOrCreate(['name' => 'AccessManagement-Index']);
        Permission::firstOrCreate(['name' => 'AccessManagement-Create']);
        Permission::firstOrCreate(['name' => 'AccessManagement-Edit']);
        Permission::firstOrCreate(['name' => 'AccessManagement-View']);
        Permission::firstOrCreate(['name' => 'AccessManagement-Delete']);

        // ===== SETTINGS =====
        // Permission::firstOrCreate(['name' => 'Settings-Index']);
        Permission::firstOrCreate(['name' => 'Company-Index']);
        Permission::firstOrCreate(['name' => 'Company-Edit']);

        // ===== ROLES =======
        $superAdmin = Role::firstOrCreate(['name' => 'Super Admin']);
        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $cleaner = Role::firstOrCreate(['name' => 'Cleaner']);
        $customer = Role::firstOrCreate(['name' => 'Customer']);

        // Super Admin — all permissions
        $permissions = Permission::all();
        $superAdmin->syncPermissions($permissions);

        // Admin — almost all permissions except force delete and settings access
        $admin->syncPermissions([
            'Dashboard',
            'AccessManagement-Index',
            'AccessManagement-Create',
            'AccessManagement-Edit',
            'AccessManagement-View',
            'AccessManagement-Delete',
        ]);
    }
}
