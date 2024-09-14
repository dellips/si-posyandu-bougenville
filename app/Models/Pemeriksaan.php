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

    public function getPerubahanBeratAttribute()
{
    // Ambil pemeriksaan terakhir berdasarkan sasaran_id dan tgl_kegiatan
    $pemeriksaan_terakhir = Pemeriksaan::where('sasaran_id', $this->sasaran_id)
        ->join('kegiatans', 'pemeriksaans.kegiatan_id', '=', 'kegiatans.id') // Join dengan tabel kegiatans
        ->orderBy('kegiatans.tgl_kegiatan', 'desc') // Urutkan berdasarkan tgl_kegiatan dari tabel kegiatans
        ->select('pemeriksaans.*') // Pilih semua kolom dari tabel pemeriksaans
        ->first();

    $pemeriksaan_sebelumnya = Pemeriksaan::where('sasaran_id', $this->sasaran_id)
        ->join('kegiatans', 'pemeriksaans.kegiatan_id', '=', 'kegiatans.id') // Join dengan tabel kegiatans
        ->orderBy('kegiatans.tgl_kegiatan', 'desc') // Urutkan berdasarkan tgl_kegiatan dari tabel kegiatans
        ->skip(1)
        ->select('pemeriksaans.*') // Pilih semua kolom dari tabel pemeriksaans
        ->first();

    // Perhitungan perubahan berat seperti sebelumnya
    if ($pemeriksaan_terakhir && !$pemeriksaan_sebelumnya) {
        return [
            'perubahan' => 0,
            'status' => 'tetap',
            'berat_sekarang' => $pemeriksaan_terakhir->bb,
            'berat_sebelumnya' => $pemeriksaan_terakhir->bb
        ];
    }

    if ($pemeriksaan_terakhir && $pemeriksaan_sebelumnya) {
        $beratSekarang = $pemeriksaan_terakhir->bb;
        $beratSebelumnya = $pemeriksaan_sebelumnya->bb;

        $perubahan = $beratSekarang - $beratSebelumnya;

        $status = $perubahan > 0 ? 'naik' : ($perubahan < 0 ? 'turun' : 'tetap');

        return [
            'perubahan' => $perubahan,
            'status' => $status,
            'berat_sekarang' => $beratSekarang,
            'berat_sebelumnya' => $beratSebelumnya
        ];
    }

    return null; // Jika tidak ada data
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
