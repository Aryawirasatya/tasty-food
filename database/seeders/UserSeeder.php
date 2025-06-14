<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $superadminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where('name', 'admin')->first();

        $superadmin = User::firstOrCreate(
            ['email' => 'superadmin@example.com'],
            [
                'name' => 'superadmin',
                'password' => Hash::make('password'),
            ]
        );
        $superadmin->role()->associate($superadminRole)->save();

        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'admin',
                'password' => Hash::make('password'),
            ]
        );
        $admin->role()->associate($adminRole)->save();
    }
}
