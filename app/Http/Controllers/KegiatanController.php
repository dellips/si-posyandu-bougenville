<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $order = $request->get('order', 'tgl_kegiatan');  
        $direction = $request->get('direction', 'asc');  

        $kegiatans = Kegiatan::orderBy($order, $direction)->get();
        return view('kegiatan.index', compact('kegiatans'));
    }

    public function data(){
        $kegiatans = Kegiatan::all();
        return $kegiatans;
    }


    public function create()
    {
        return view('kegiatan.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nm_kegiatan' => 'required|string|max:255',
            'tgl_kegiatan' => 'required|date',
            'ket' => 'string|max:255',
        ]);

        Kegiatan::create($validatedData);
        return redirect()->route('kegiatan.index')->with('success', 'Jadwal Kegiatan Posyandu berhasil disimpan.');
    }


    public function show(Kegiatan $kegiatan){
        $kegiatan->load('pemeriksaan'); 
        $kegiatans = Kegiatan::all();
        return view('kegiatan.show', compact('kegiatan',  'kegiatans'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kegiatan $kegiatan)
    {
        if (!$kegiatan) {
            return redirect()->route('kegiatan.index')->with('error', 'Data Kegiatan Posyandu tidak ditemukan.');
        }
        return view('kegiatan.form', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validatedData = $request->validate([
            'nm_kegiatan' => 'nullable|string|max:255',
            'tgl_kegiatan' => 'nullable|date',
            'ket' => 'string|max:255',
        ]);

        if (!$kegiatan) {
            return redirect()->route('kegiatan.index')->with('error', 'Data Kegiatan Posyandu tidak ditemukan.');
        }

        $kegiatan->update($validatedData);
        return redirect()->route('kegiatan.index', $kegiatan->id)->with('success', 'Jadwal Kegiatan Posyandu berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')->with('success', 'Jadwal Kegiatan Posyandu berhasil dihapus.');
    }

    public function filter(Request $request)
{
    $query = Kegiatan::query();

    // Filter berdasarkan bulan atau tahun
    if ($request->filter === 'month') {
        $query->whereMonth('tgl_kegiatan', now()->month);
    } elseif ($request->filter === 'year') {
        $query->whereYear('tgl_kegiatan', now()->year);
    }

    // Sorting berdasarkan kolom yang dipilih
    if ($request->has(['order', 'direction'])) {
        $query->orderBy($request->order, $request->direction);
    }

    $kegiatans = $query->get();

    return response()->json($kegiatans);
}




}
