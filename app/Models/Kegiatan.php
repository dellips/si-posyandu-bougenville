<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $table = 'kegiatans';

    protected $fillable = [
        'nm_kegiatan',
        'tgl_kegiatan',
        'ket',
    ];

    public function pemeriksaan(){
        return $this->hasMany(Pemeriksaan::class);
    }
}
