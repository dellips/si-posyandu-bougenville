<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class IbuController extends Controller
{
    // mengambil seluruh data ibu keseluruhan
    public function index(Request $request)
    {
        $sortColumn = $request->input('sort', 'nama');
        $sortDirection = $request->input('direction', 'asc');

        $ibus = Ibu::orderBy($sortColumn, $sortDirection)->get();
        return view('ibu.index', compact('ibus', 'sortColumn', 'sortDirection'));
    }

    //menampilkan form untuk membuat data baru
    public function create()
    {
        return view('ibu.form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nik' => 'required|string|digits:16|unique:ibus,nik',
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'no_telp' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,13',
            'is_hamil' => 'required|boolean',
            'bpjs' => 'required|string',
        ]);

        
        Ibu::create($validatedData);
        return redirect()->route('ibu.index')->with('success', 'Data Ibu berhasil disimpan.');
    }

    public function show(Ibu $ibu)
    {
        $ibu = Ibu::with('anak')->findOrFail($ibu->id);
        $usia = Carbon::parse($ibu->tgl_lahir)->age;

        if (!$ibu) {
            return redirect()->route('ibu.index')->with('error', 'Data Ibu tidak ditemukan.');
        }
        return view('ibu.show', compact('ibu', 'usia'));
    }

    public function edit(Ibu $ibu)
    {
        if (!$ibu->exists) {
            return redirect()->route('ibu.index')->with('error', 'Data Ibu tidak ditemukan.');
        }
        return view('ibu.form', compact('ibu'));
    }

    public function update(Request $request, $id)
    {

        $validatedData = $request->validate([
            'nik' => ['required', 'string', 'digits:16', Rule::unique('ibus', 'nik')->ignore($id)],
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'no_telp' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,13',
            'is_hamil' => 'required|boolean',
            'bpjs' => 'nullable|string',
        ]);
        
        $ibu = Ibu::findOrFail($id);

        if (!$ibu->exists) {
            return redirect()->route('ibu.index')->with('error', 'Data Ibu tidak ditemukan.');
        }

        $ibu->update($validatedData);
        return redirect()->route('ibu.show', $ibu->id)->with('success', 'Data Ibu berhasil diperbarui.');
    }

    public function destroy(Ibu $ibu)
    {
        $ibu->delete();
        return redirect()->route('ibu.index')->with('success', 'Data Ibu berhasil dihapus.');
    }

}
