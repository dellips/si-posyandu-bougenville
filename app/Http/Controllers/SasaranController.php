<?php

namespace App\Http\Controllers;

use App\Models\Sasaran;
use App\Models\Pemeriksaan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SasaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $order = $request->get('order', 'nama');  // Default: urutkan berdasarkan 'nama'
    $direction = $request->get('direction', 'asc');  // Default: 'asc'
    $activeTab = $request->get('activeTab', 'Semua Data');  // Default: tab 'Semua Data'

    $sasarans = Sasaran::orderBy($order, $direction)->get();

    $filteredSasarans = [
        'Semua Data' => $sasarans,
        'Ibu Hamil' => $sasarans->where('kategori', 'Ibu Hamil'),
        'Ibu dan Anak' => $sasarans->where('kategori', 'Ibu'),
        'Lansia' => $sasarans->where('kategori', 'Lansia'),
    ];

    return view('sasaran.index', compact('sasarans', 'filteredSasarans', 'activeTab'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sasaran.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|string|digits:16|unique:sasarans,nik', 
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'kategori' => 'required|string', 
            'jk' => 'required|string', 
            'alamat' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'status_bpjs' => 'nullable|string', 
            'no_telp' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,13',
        ], [], [
            'nik' => 'NIK',
            'nama' => 'Nama Lengkap',
            'jk' => 'Jenis Kelamin',
            'tgl_lahir' => 'Tanggal Lahir',
            'kategori' => 'Kategori',
            'jk' => 'Jenis Kelamin',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
            'status_bpjs' => 'Status BPJS',
            'no_telp' => 'Nomor Telepon',
        ]);
        

        Sasaran::create($validatedData);
        return redirect()->route('sasaran.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sasaran $sasaran)
{
    // Mengambil data pemeriksaan beserta relasi kegiatan
    $pemeriksaan = Pemeriksaan::where('sasaran_id', $sasaran->id)->with('kegiatan')->get();

    return view('sasaran.show', compact('sasaran', 'pemeriksaan'));
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sasaran $sasaran)
    {
        $sasaran = Sasaran::find($sasaran->id);
        if (!$sasaran->exists) {
            return redirect()->route('sasaran.index')->with('error', 'Data tidak ditemukan.');
        }
        return view('sasaran.form', compact('sasaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'nullable|string|digits:16|unique:sasarans,nik,' . $id,
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'kategori' => 'required|string', 
            'jk' => 'required|string', 
            'alamat' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'status_bpjs' => 'nullable|string', 
            'no_telp' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,13',
        ], [], [
            'nik' => 'NIK',
            'nama' => 'Nama Lengkap',
            'jk' => 'Jenis Kelamin',
            'tgl_lahir' => 'Tanggal Lahir',
            'kategori' => 'Kategori',
            'jk' => 'Jenis Kelamin',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
            'status_bpjs' => 'Status BPJS',
            'no_telp' => 'Nomor Telepon',
        ]);

        $sasaran = Sasaran::find($id);

    if (!$sasaran) {
        return redirect()->route('sasaran.index')->with('error', 'Data tidak ditemukan.');
    }

    $sasaran->update($request->all());

    return redirect()->route('sasaran.show', $sasaran->id)->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sasaran $sasaran)
    {
        $sasaran->delete();
        return redirect()->route('sasaran.index')->with('success', 'Data berhasil dihapus.');
    }

    public function filter(Request $request)
{
    // Ambil parameter filter, order, dan direction
    $filter = $request->query('filter', []);
    $order = $request->query('order', 'nama'); // Default sorting by 'nama'
    $direction = $request->query('direction', 'asc'); // Default ascending

    // Validasi direction (asc atau desc)
    if (!in_array($direction, ['asc', 'desc'])) {
        return response()->json(['error' => 'Invalid sorting direction'], 400);
    }

    // Mulai query
    $query = Sasaran::query();

    // Jika ada filter, terapkan ke query
    if (!empty($filter) && is_array($filter)) {
        foreach ($filter as $key => $value) {
            $query->where($key, $value);
        }
    }

    // Terapkan pengurutan
    $sasarans = $query->orderBy($order, $direction)->get();

    return response()->json($sasarans);
}

}
