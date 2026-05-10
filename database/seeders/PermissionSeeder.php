<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Reset Cached Roles & Permissions
        |--------------------------------------------------------------------------
        */

        app()[PermissionRegistrar::class]
            ->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Create Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [

            'manage users',
            'manage prescriptions',
            'manage quotations',

        ];

        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Assign Permissions To Roles
        |--------------------------------------------------------------------------
        */

        $adminRole = Role::findByName('admin');

        $adminRole->givePermissionTo($permissions);

        $pharmacyRole = Role::findByName('pharmacy');

        $pharmacyRole->givePermissionTo([
            'manage prescriptions',
            'manage quotations',
        ]);
    }
}