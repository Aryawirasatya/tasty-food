<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contactMessage extends Model
{
    protected $fillable = [
        'subject',
        'nama',
        'email',
        'pesan',
    ];
}
