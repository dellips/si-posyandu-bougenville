<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Anak;
use App\Models\User;
use App\Models\Sasaran;
use App\Models\Kegiatan;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $today = Carbon::today(); // Menggunakan Carbon untuk mendapatkan tanggal hari ini
        $kegiatanToday = Kegiatan::whereDate('tgl_kegiatan', $today)->get();        
        $kegiatan = Kegiatan::all();

        $jml_ibuHamil = Sasaran::where('kategori', 'Ibu Hamil')->count();
        $jml_anak = Anak::count();
        $jml_lansia = Sasaran::where('kategori', 'Lansia')->count();
        $jml_kader = User::where(function($query) {
            $query->where('is_admin', false)
                  ->orWhere(function($subQuery) {
                      $subQuery->where('is_admin', true)
                               ->whereIn('posisi', ['Ketua', 'Wakil Ketua', 'Sekretaris', 'Bendahara', 'Anggota']);
                  });
        })->count();
        
        $pemeriksaanCounts = Pemeriksaan::with('kegiatan') // Pastikan 'kegiatan' adalah nama relasi yang tepat
        ->selectRaw('kegiatan_id, count(*) as total')
        ->groupBy('kegiatan_id')
        ->get();

        $pemeriksaanPerKegiatan = $pemeriksaanCounts->mapWithKeys(function ($item) {
            return [$item->kegiatan->nm_kegiatan => $item->total];
        });

        return view('dashboard', compact('kegiatanToday', 
                                        'kegiatan', 
                                        'jml_ibuHamil', 
                                        'jml_anak', 
                                        'jml_lansia', 
                                        'jml_kader',
                                        'pemeriksaanCounts',
                                        'pemeriksaanPerKegiatan',
                                    ));
    }

    public function filter(Request $request)
{
    $filter = $request->query('filter');
    $today = Carbon::today();
    $kegiatan = [];

    if ($filter === 'today') {
        $kegiatan = Kegiatan::whereDate('tgl_kegiatan', $today)->get();
    } elseif ($filter === 'month') {
        $kegiatan = Kegiatan::whereMonth('tgl_kegiatan', $today->month)
                            ->whereYear('tgl_kegiatan', $today->year)
                            ->get();
    } elseif ($filter === 'year') {
        $kegiatan = Kegiatan::whereYear('tgl_kegiatan', $today->year)->get();
    } else {
        $kegiatan = Kegiatan::all();
    }

    return response()->json($kegiatan);
}

public function filterKegiatan(Request $request)
{
    $filter = $request->query('filter');
    $today = Carbon::today();
    $kegiatanQuery = Kegiatan::query();

    if ($filter === 'today') {
        $kegiatanQuery->whereDate('tgl_kegiatan', $today);
    } elseif ($filter === 'month') {
        $kegiatanQuery->whereMonth('tgl_kegiatan', now()->month);
    } elseif ($filter === 'year') {
        $kegiatanQuery->whereYear('tgl_kegiatan', now()->year);
    }

    $kegiatanFiltered = $kegiatanQuery->get();
    $pemeriksaanCounts = Pemeriksaan::with('kegiatan')
        ->whereIn('kegiatan_id', $kegiatanFiltered->pluck('id'))
        ->selectRaw('kegiatan_id, count(*) as total')
        ->groupBy('kegiatan_id')
        ->get();

    $response = $pemeriksaanCounts->map(function ($item) {
        return [
            'nm_kegiatan' => $item->kegiatan->nm_kegiatan,
            'jumlah_pemeriksaan' => $item->total,
        ];
    });

    return response()->json($response);
}

}
