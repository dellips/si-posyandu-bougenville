<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ibu extends Model
{
    use HasFactory;

    public function anak(){
        return $this->hasMany(Anak::class);
    }


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
    
    public function getStatusHamilAttribute()
    {
        return $this->is_hamil ? 'Hamil' : 'Tidak Hamil';
    }

}

