<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Admin User
        |--------------------------------------------------------------------------
        */

        $admin = User::create([

            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('test@123'),

        ]);

        $admin->assignRole('admin');

        /*
        |--------------------------------------------------------------------------
        | Pharmacy User
        |--------------------------------------------------------------------------
        */

        $pharmacy = User::create([

            'name' => 'Pharmacy User',
            'email' => 'pharmacy@test.com',
            'password' => Hash::make('test@123'),

        ]);

        $pharmacy->assignRole('pharmacy');

        /*
        |--------------------------------------------------------------------------
        | Customer User
        |--------------------------------------------------------------------------
        */

        $customer = User::create([

            'name' => 'Customer User',
            'email' => 'customer@test.com',
            'password' => Hash::make('test@123'),

        ]);

        $customer->assignRole('customer');
    }
}