<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 

class InformasiKontak extends Model
{
    protected $table = 'informasi_kontak';

    protected $fillable = [
        'alamat', 'email', 'telepon',
        'link_maps', 'url_email', 'url_telepon', 'url_alamat',
    ];
}
