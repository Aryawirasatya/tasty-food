<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = "berita";

    protected $fillable = [
        'judul',
        'konten',
         'gambar',
         'utama',
    ];

    public $timestamps = true;

}
