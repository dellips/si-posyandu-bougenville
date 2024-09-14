<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Sasaran;
use App\Models\Kegiatan;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{

    public function index(Request $request)
{
    $kegiatans = Kegiatan::all();
    $pemeriksaans = Pemeriksaan::with(['sasaran', 'anak'])->get();
    
    return view('pemeriksaan.index', compact('pemeriksaans', 'kegiatans'));
}

    public function create(Request $request)
{
    $type = $request->query('type'); 
    $ibuHamil = Sasaran::where('kategori', 'Ibu Hamil')->get(['id', 'nama']);
    $ibu = Sasaran::where('kategori', 'Ibu')->get(['id', 'nama']);
    $anak = Anak::all();
    $lansia = Sasaran::where('kategori', 'Lansia')->get(['id', 'nama']);
    $kegiatan = Kegiatan::all();

    return view('pemeriksaan.form', compact('ibuHamil', 'ibu', 'anak', 'lansia', 'kegiatan', 'type'));
}


    public function store(Request $request)
    {
        $validateData = $request->validate([
            'bb' => 'required|numeric',
            'tb' => 'required|numeric',
            'lk' => 'nullable|numeric',
            'pl' => 'nullable|numeric',
            'lila' => 'nullable|numeric',
            'lp' => 'nullable|numeric',
            'sistolik' => 'nullable|numeric',
            'diastolik' => 'nullable|numeric',
            'vit_a' => 'nullable|string|max:255',
            'obat_cacing' => 'nullable|string|max:255',
            'tambah_darah' => 'nullable|string|max:255',
            'bulan_ke' => 'nullable|string|max:255',
            'ket' => 'nullable|string|max:255',
            'sasaran_id' => 'nullable|exists:sasarans,id',
            'anak_id' => 'nullable|exists:anaks,id',
            'kegiatan_id' => 'required|exists:kegiatans,id',
        ]);

        // Determine which ID to use based on the category
    if ($request->category === 'Ibu Hamil' || $request->category === 'Lansia' || $request->category === 'Ibu') {
        $validatedData['sasaran_id'] = $request->sasaran_id;
    } else if ($request->category === 'Anak') {
        $validatedData['anak_id'] = $request->anak_id;
    }


        Pemeriksaan::create($validateData);
        return redirect()->route('pemeriksaan.index')->with('success', 'Data Pemeriksaan berhasil disimpan.');
    }


    public function show($id)
    {
        // Ambil pemeriksaan berdasarkan id
        $pemeriksaan = Pemeriksaan::find($id);
        return view('pemeriksaan.show', compact('pemeriksaan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemeriksaan $pemeriksaan)
{
    $type = $pemeriksaan->ibu_hamil ? 'ibu_hamil' : ($pemeriksaan->anak ? 'anak' : 'lansia'); // Tentukan tipe berdasarkan data pemeriksaan
    $ibuHamil = Sasaran::where('kategori', 'Ibu Hamil')->get(['id', 'nama']);
    $ibu = Sasaran::where('kategori', 'Ibu')->get(['id', 'nama']);
    $anak = Anak::all();
    $lansia = Sasaran::where('kategori', 'Lansia')->get(['id', 'nama']);
    $kegiatan = Kegiatan::all();

    if (!$pemeriksaan) {
        return redirect()->route('pemeriksaan.index')->with('error', 'Data Pemeriksaan tidak ditemukan.');
    }
    return view('pemeriksaan.form', compact('pemeriksaan', 'ibu', 'ibuHamil', 'anak', 'lansia', 'kegiatan', 'type'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $validateData = $request->validate([
            'bb' => 'required|numeric',
            'tb' => 'required|numeric',
            'lk' => 'nullable|numeric',
            'lp' => 'nullable|numeric',
            'pl' => 'nullable|numeric',
            'lila' => 'nullable|numeric',
            'lp' => 'nullable|numeric',
            'sistolik' => 'nullable|numeric',
            'diastolik' => 'nullable|numeric',
            'vit_a' => 'nullable|string|max:255',
            'vit_a' => 'nullable|string|max:255',
            'obat_cacing' => 'nullable|string|max:255',
            'tambah_darah' => 'nullable|string|max:255',
            'bulan_ke' => 'nullable|string|max:255',
            'ket' => 'nullable|string|max:255',
            'sasaran_id' => 'nullable|exists:sasarans,id',
            'anak_id' => 'nullable|exists:anaks,id',
            'kegiatan_id' => 'required|exists:kegiatans,id',
        ]);

        $pemeriksaan->update($validateData);
        return redirect()->route('pemeriksaan.show', $pemeriksaan->id)->with('success', 'Data Pemeriksaan berhasil disimpan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->delete();
        return redirect()->route('pemeriksaan.index')->with('success', 'Data Pemeriksaan berhasil dihapus.');
    }

    public function data(){
        $pemeriksaans = Pemeriksaan::all();
        return $pemeriksaans;
    }

    public function hitungIMTdewasa($beratBadan, $tinggiBadan)
{
    if ($tinggiBadan <= 0 || $beratBadan <= 0) {
        return ['imt' => null, 'keterangan' => 'Data tidak valid']; // Menghindari pembagian dengan nol atau nilai negatif
    }

    // Konversi tinggi badan dari cm ke meter
    $tinggiMeter = $tinggiBadan / 100;

    // Hitung IMT
    $imt = $beratBadan / ($tinggiMeter * $tinggiMeter);

    // Tentukan keterangan berdasarkan nilai IMT
    if ($imt < 17) {
        $keterangan = 'Sangat Kurus';
    } elseif ($imt >= 17 && $imt <= 18.5) {
        $keterangan = 'Kurus';
    } elseif ($imt >= 18.5 && $imt <= 25) {
        $keterangan = 'Normal';
    } elseif ($imt > 25 && $imt <= 27) {
        $keterangan = 'Gemuk';
    } else {
        $keterangan = 'Obesitas';
    }

    return ['imt' => round($imt, 2), 'keterangan' => $keterangan];
}

public function hitungPerubahanBerat($pemeriksaan)
    {
        // Ambil pemeriksaan terakhir dan sebelumnya berdasarkan sasaran_id dan tgl_kegiatan
        $pemeriksaan_terakhir = Pemeriksaan::where('sasaran_id', $pemeriksaan->sasaran_id)
            ->orderBy('kegiatan.tgl_kegiatan', 'desc')
            ->first();

        $pemeriksaan_sebelumnya = Pemeriksaan::where('sasaran_id', $pemeriksaan->sasaran_id)
            ->orderBy('kegiatan.tgl_kegiatan', 'desc')
            ->skip(1)
            ->first();

        // Jika tidak ada data pemeriksaan sebelumnya
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

            // Tentukan status kenaikan/penurunan berat badan
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

    public function filter(Request $request)
{
    // Ambil parameter dari request
    $kegiatanId = $request->input('kegiatan');
    $kategori = $request->input('kategori');

    // Buat query untuk memfilter data
    $query = Pemeriksaan::query();

    // Filter berdasarkan kegiatan jika ada
    if (!empty($kegiatanId)) {
        $query->where('kegiatan_id', $kegiatanId);
    }

    // Filter berdasarkan kategori jika ada
    if (!empty($kategori)) {
        if ($kategori == 'Anak') {
            $query->whereHas('anak');
        } else {
            $query->whereHas('sasaran', function ($q) use ($kategori) {
                $q->where('kategori', $kategori);
            });
        }
    }

    // Ambil data pemeriksaan dengan relasi sasaran dan anak
    $pemeriksaans = $query->with(['sasaran', 'anak'])->get();

    // Kembalikan data sebagai JSON untuk AJAX
    if ($request->ajax()) {
        return response()->json($pemeriksaans);
    }

    // Jika bukan AJAX, kembalikan ke view biasa
    return view('pemeriksaan.index', compact('pemeriksaans'));
}



}
