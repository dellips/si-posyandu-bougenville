<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\Ibu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anaks = Anak::with('ibu')->get();
        return view('anak.index', compact('anaks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ibu = Ibu::all();
        return view('anak.form', compact('ibu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
            'nm_ayah' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'bb_lahir' => 'required|numeric',
            'tb_lahir' => 'required|numeric',
            'jk' => 'required|string',
            'anak_ke' => 'required|string|max:3',
            'jns_persalinan' => 'required|string',
            'ibu_id' => 'required|exists:ibus,id',
        ]);

        Anak::create($validatedData);
        return redirect()->route('anak.index')->with('success', 'Data Anak berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Anak $anak)
    {
        $usia = Carbon::parse($anak->tgl_lahir)->age;
        return view('anak.index', compact('anak', 'usia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anak $anak)
    {
        $ibu = Ibu::all();
        return view('anak.form', compact('anak', 'ibu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Anak $anak)
    {
        $validatedData = $request->validate([
            'nik' => 'nullable|string|max:255',
            'nama' => 'required|string|max:255',
            'nm_ayah' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'bb_lahir' => 'required|numberic',
            'tb_lahir' => 'required|numberic',
            'jk' => 'required|string',
            'anak_ke' => 'required|string|max:3',
            'jns_persalinan' => 'required|string',
            'ibu_id' => 'required|exists:ibus,id',
        ]);

        $anak->update($validatedData);
        return redirect()->route('anak.show', $anak->id)->with('success', 'Data Anak berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anak $anak)
    {
        $anak->delete();
        return redirect()->route('anak.index')->with('success', 'Data Ibu berhasil dihapus.');
    }
}
