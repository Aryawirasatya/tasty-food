<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'roles.index',
            'roles.create',
            'roles.edit',
            'roles.delete',
            'users.index',
            'users.create',
            'users.edit',
            'users.delete',
            // Tambah sesuai kebutuhan
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
