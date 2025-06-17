<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Hapus semua relasi permission dengan role

        // Hapus semua permission
        // Buat permission baru (per menu)
        $permissions = [
            'akses_berita',
            'akses_galeri',
            'akses_kontak',
            'akses_pesan',
            'akses_tentang',
        ];

        foreach ($permissions as $name) {
            Permission::firstOrCreate(['name' => $name]);
        }
    }
}
