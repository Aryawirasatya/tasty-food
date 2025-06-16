<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // Berita
            'lihat_berita', 'tambah_berita', 'edit_berita', 'hapus_berita',

            // Galeri
            'lihat_galeri', 'tambah_galeri', 'edit_galeri', 'hapus_galeri',

            // Kontak
            'lihat_kontak', 'edit_kontak',

            // Pesan
            'lihat_pesan', 'hapus_pesan',

            // Tentang
            'lihat_tentang', // ⬅️ Tambahkan ini
            'edit_tentang',
        ];

        foreach ($permissions as $name) {
            Permission::firstOrCreate(['name' => $name]);
        }
    }
}
