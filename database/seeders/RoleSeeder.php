<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $superadmin = Role::firstOrCreate(['name' => 'superadmin']);

        // Ambil semua permission
        $permissions = Permission::all()->pluck('id');

        // Superadmin dapat semua permission
        $superadmin->permissions()->sync($permissions);

        // Admin dapat sebagian permission (opsional, sesuai kebutuhan)
        $admin->permissions()->sync(
            Permission::whereIn('name', [
                'roles.index',
                'users.index',
                // dll
            ])->pluck('id')
        );
    }
}
