<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use App\Models\Anak;
use App\Models\Sasaran;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortColumn = $request->input('sort', 'nama');
        $sortDirection = $request->input('direction', 'asc');

        $anaks = Anak::with('sasaran')
            ->orderBy($sortColumn, $sortDirection)
            ->get();
        return view('sasaran.index', compact('anaks', 'sortColumn', 'sortDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sasaran = Sasaran::where('kategori', 'Ibu')->get();
        return view('anak.form', compact('sasaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'nullable|string|digits:16|unique:anaks,nik',
            'nama' => 'required|string|max:255',
            'nm_ayah' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'bb_lahir' => 'required|numeric',
            'tb_lahir' => 'required|numeric',
            'jk' => 'required|string',
            'jns_persalinan' => 'required|string',
            'jns_kelahiran' => 'required|string',
            'sasaran_id' => 'required|exists:sasarans,id',
        ]);

        Anak::create($validatedData);
        return redirect()->route('sasaran.index')->with('success', 'Data Anak berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anak $anak)
    {
        $anak = Anak::with('sasaran')->findOrFail($anak->id);
        if (!$anak) {
            return redirect()->route('anak.index')->with('error', 'Data Anak tidak ditemukan.');
        }
        return view('sasaran.show', compact('anak'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anak $anak)
    {
        $sasaran = Sasaran::where('kategori', 'Ibu')->get();

        if (!$anak) {
            return redirect()->route('sasaran.index')->with('error', 'Data Anak tidak ditemukan.');
        }
        return view('anak.form', compact('anak', 'sasaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nik' => 'nullable|string|digits:16|unique:anaks,nik'.$id,
            'nama' => 'required|string|max:255',
            'nm_ayah' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'bb_lahir' => 'required|numeric',
            'tb_lahir' => 'required|numeric',
            'jk' => 'required|string',
            'jns_persalinan' => 'required|string',
            'jns_kelahiran' => 'required|string',
            'sasaran_id' => 'required|exists:sasarans,id',
        ]);

        $anak = Anak::findOrFail($id);

        if (!$anak) {
            return redirect()->route('sasaran.index')->with('error', 'Data Anak tidak ditemukan.');
        }

        $anak->update($validatedData);
        return redirect()->route('sasaran.show', $anak->id)->with('success', 'Data Anak berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anak $anak)
    {
        $anak->delete();
        return redirect()->route('sasaran.index')->with('success', 'Data Ibu berhasil dihapus.');
    }
}
