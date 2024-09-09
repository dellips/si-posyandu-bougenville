<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sasaran extends Model
{
    use HasFactory;

    public function anak(){
        return $this->hasMany(Anak::class, 'sasaran_id');
    }

    protected $fillable = [
        'nik',
        'nama',
        'jk',
        'tgl_lahir',
        'alamat',
        'kategori',
        'rt',
        'rw',
        'no_telp',
        'status_bpjs',
    ];
}
