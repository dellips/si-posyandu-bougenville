<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anak extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama',
        'nm_ibu',
        'nm_ayah',
        'tgl_lahir',
        'bb_lahir',
        'tb_lahir',
        'anak_ke',
    ];

    public function ibu(){
        return $this->belongsTo(Ibu::class);
    }

}

