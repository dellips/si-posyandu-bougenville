<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class IbuController extends Controller
{
    // mengambil seluruh data ibu keseluruhan
    public function index()
    {
        $ibus = Ibu::all();
        return view('ibu.index', compact('ibus'));
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
            'no_telp' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'is_hamil' => 'required|string',
            'bpjs' => 'required|string',
        ]);

        // Menggunakan mass assignment
        Ibu::create($validatedData);
        return redirect()->route('ibu.index')->with('success', 'Data Ibu berhasil disimpan.');
    }

    public function show(Ibu $ibu)
    {
        //tambahan menghitung usia
        $usia = Carbon::parse($ibu->tgl_lahir)->age;
        return view('ibu.show', compact('ibu', 'usia'));
    }

    public function edit(Ibu $ibu)
    {
        return view('ibu.form', compact('ibu'));
    }

    public function update(Request $request, Ibu $ibu)
    {

        $validatedData = $request->validate([
            'nik' => 'required|string|digits:16',
            'nama' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'rt' => 'required|string|max:3',
            'rw' => 'required|string|max:3',
            'no_telp' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'is_hamil' => 'required|string',
            'bpjs' => 'required|string',
        ]);

        $ibu->update($validatedData);
        return redirect()->route('ibu.show', $ibu->id)->with('success', 'Data Ibu berhasil diperbarui.');
    }

    public function destroy(Ibu $ibu)
    {
        $ibu->delete();
        return redirect()->route('ibu.index')->with('success', 'Data Ibu berhasil dihapus.');
    }
}
