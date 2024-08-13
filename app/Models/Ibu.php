<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ibu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'tgl_lahir',
        'alamat',
        'rt',
        'rw',
        'no_telp',
        'is_hamil',
        'bpjs',
    ];
}

