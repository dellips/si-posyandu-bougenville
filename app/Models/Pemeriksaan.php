<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'bb',
        'tb',
        'lk',
        'pl',
        'lila',
        'lp',
        'sistolik',
        'diastolik',
        'vit_a',
        'obat_cacing',
        'tambah_darah',
        'bulan_ke',
        'ket',
        'sasaran_id',
        'anak_id',
        'kegiatan_id',
    ];

    public function getImtAttribute()
    {
        if ($this->tb == 0) {
            return null;
        }

        $tinggiMeter = $this->tb / 100;
        return round($this->bb / ($tinggiMeter * $tinggiMeter), 2);
    }

    // Accessor untuk Keterangan berdasarkan IMT
    public function getKeteranganAttribute()
    {
        $imt = $this->imt;

        if ($imt === null) {
            return 'Data tidak valid';
        }

        if ($imt < 17) {
            return 'Sangat Kurus';
        } elseif ($imt >= 17 && $imt <= 18.5) {
            return 'Kurus';
        } elseif ($imt > 18.5 && $imt <= 25) {
            return 'Normal';
        } elseif ($imt > 25 && $imt <= 27) {
            return 'Gemuk';
        } else {
            return 'Obesitas';
        }
    }

    public function sasaran()
{
    return $this->belongsTo(Sasaran::class, 'sasaran_id');
}

public function anak()
{
    return $this->belongsTo(Anak::class, 'anak_id');
}

public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'kegiatan_id');
    }

}
