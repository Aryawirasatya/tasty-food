<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    protected $table = 'tentang';

    protected $fillable = [
    'judul',
    'deskripsi',
    'deskripsi_lanjutan',
    'judul_visi',
    'isi_visi',
    'judul_misi',
    'isi_misi',
    'gambar_profil',
    'gambar_visimisi',
];
}
