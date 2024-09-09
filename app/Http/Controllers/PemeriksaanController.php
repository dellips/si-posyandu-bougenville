<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use App\Models\Anak;
use App\Models\Lansia;
use App\Models\Kegiatan;
use App\Models\Pemeriksaan;
use App\Models\Sasaran;
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

        if (!$pemeriksaan) {
            return redirect()->route('pemeriksaan.index')->with('error', 'Data Pemeriksaan tidak ditemukan.');
        }

        $pemeriksaan->update($validateData);
        return redirect()->route('pemeriksaan.show')->with('success', 'Data Pemeriksaan berhasil disimpan.');
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

    public function hitungIMTabak($beratBadanLahir, $usia){

    }

    public function filter(Request $request)
{
    $query = Pemeriksaan::query();

    if ($request->kategori) {
        $query->whereHas('sasaran', function ($q) use ($request) {
            $q->where('kategori', $request->kategori);
        });
    }

    if ($request->nama) {
        $query->whereHas('sasaran', function ($q) use ($request) {
            $q->where('nama', 'like', '%' . $request->nama . '%');
        });
    }

    if ($request->kegiatan) {
        $query->where('kegiatan_id', $request->kegiatan);
    }

    $pemeriksaans = $query->with('sasaran', 'anak')->get(); // Pastikan relasi dengan sasaran dan anak sudah di-load

    return response()->json($pemeriksaans);
}





}
