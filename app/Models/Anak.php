<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anak extends Model
{
    use HasFactory;

    public function sasaran(){
        return $this->belongsTo(Sasaran::class);
    }

    protected $fillable = [
        'nik',
        'nama',
        'nm_ayah',
        'tgl_lahir',
        'bb_lahir',
        'tb_lahir',
        'jk',
        'jns_persalinan',
        'jns_kelahiran',
        'sasaran_id',
    ];


}

