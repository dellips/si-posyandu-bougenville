<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Ibu;
use App\Models\Kegiatan;
use App\Models\Lansia;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{

    public function index()
    {
        $kegiatans = Kegiatan::all();
        $pemeriksaans = Pemeriksaan::with(['sasaran', 'anak'])->get();
        return view('laporan.index', compact('pemeriksaans', 'kegiatans'));
    }


    public function exportPdf(Request $request)
{
    $bulan = $request->input('bulan');
    $tahun = $request->input('tahun');

    if (!$bulan || !$tahun) {
        return redirect()->back()->with('error', 'Bulan dan Tahun harus dipilih.');
    }

    // Convert bulan dan tahun menjadi rentang tanggal
    $startDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->startOfMonth();
    $endDate = \Carbon\Carbon::createFromDate($tahun, $bulan, 1)->endOfMonth();

    // Query data pemeriksaan berdasarkan rentang tanggal
    $data = Pemeriksaan::whereBetween('tanggal_pemeriksaan', [$startDate, $endDate])->get();

    // Generate PDF dengan data yang telah difilter
    $pdf = Pdf::loadView('laporan.index', compact('data'));
    return $pdf->download('laporan-pemeriksaan-' . $bulan . '-' . $tahun . '.pdf');
}

public function exportAnakPdf()
{
    // Mengambil semua data dari tabel 'anak'
    $anak = Anak::all();

    // Generate PDF menggunakan view 'laporan.anak'
    $pdf = Pdf::loadView('laporan.anak', compact('anak'));

    // Menampilkan PDF di browser
    return $pdf->stream('laporan-anak.pdf');
}


public function exportKegiatanPdf(Request $request)
{
    // Validasi input berdasarkan jenis laporan
    if ($request->input('report_type') == 'date') {
        // Jika laporan berdasarkan tanggal, validasi input tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Ambil rentang waktu dari input pengguna
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data kegiatan berdasarkan rentang waktu
        $kegiatan = Kegiatan::whereBetween('created_at', [$startDate, $endDate])->get();
    } else {
        // Jika laporan berdasarkan kegiatan, validasi kegiatan
        $request->validate([
            'activity' => 'required|exists:kegiatans,id',
        ]);

        // Ambil data kegiatan berdasarkan kegiatan yang dipilih
        $kegiatan = Kegiatan::where('id', $request->input('activity'))->get();
    }

    // Generate PDF menggunakan view 'laporan.kegiatan'
    $pdf = Pdf::loadView('laporan.kegiatan', compact('kegiatan'));

    // Menampilkan PDF di browser
    return $pdf->stream('laporan-kegiatan.pdf');
}





}
