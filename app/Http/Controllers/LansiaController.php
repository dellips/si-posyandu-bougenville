<?php

namespace App\Http\Controllers;

use App\Models\Lansia;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class LansiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sortColumn = $request->input('sort', 'nama');
        $sortDirection = $request->input('direction', 'asc');

        $lansias = Lansia::orderBy($sortColumn, $sortDirection)->get();
        return view('lansia.index', compact('lansias', 'sortColumn', 'sortDirection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tambah-lansia');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|string|digits:16|unique:lansias,nik',
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'no_telp' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'bpjs' => 'required|string',
        ]);
        Lansia::create($validatedData);
        return redirect()->route('lansia.index')->with('success', 'Data Lansia berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    $lansia = Lansia::find($id);

    if (!$lansia || !$lansia->exists) {
        return redirect()->route('lansia.index')->with('error', 'Data lansia tidak ditemukan.');
    }

    return view('lansia.show', compact('lansia'));
}



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lansia $lansia)
    {
        $lansia = Lansia::find($lansia->id);

        if (!$lansia || !$lansia->exists) {
            return redirect()->route('lansia.index')->with('error', 'Data lansia tidak ditemukan.');
        }

        return view('lansia.form', compact('lansia'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
{
    $request->validate([
        'nik' => ['required', 'string', 'digits:16', Rule::unique('lansias', 'nik')->ignore($id)],
        'nama' => 'required|string|max:255',
        'tgl_lahir' => 'required|date',
        'alamat' => 'required|string|max:255',
        'rt' => 'required|string|max:3',
        'rw' => 'required|string|max:3',
        'no_telp' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'bpjs' => 'required|string',
    ]);

    $lansia = Lansia::find($id);

    if (!$lansia) {
        return redirect()->route('lansia.show')->with('error', 'Data tidak ditemukan.');
    }

    $lansia->update($request->all());

    return redirect()->route('lansia.index')->with('success', 'Data berhasil diperbarui.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lansia $lansia)
    {
        $lansia->delete();
        return redirect()->route('lansia.index')->with('success', 'Data Lansia berhasil dihapus');
    }
}