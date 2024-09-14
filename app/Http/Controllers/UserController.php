<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'nullable|string|max:255',
            'password' => ['nullable', 'string', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
            'nik' => 'required|string|digits:16|unique:users,nik',
            'nama' => 'required|string|max:255',
            'jk' => 'required|string',
            'tgl_lahir' => 'required|date',
            'alamat' => 'nullable|string|max:255',
            'rt' => 'nullable|string|max:3',
            'rw' => 'nullable|string|max:3',
            'posisi' => 'nullable|string',
            'posisi' => 'nullable|string',
            'no_telp' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,13',
            'is_admin' => 'boolean',
        ], [], [
            'nama' => 'Nama Lengkap',
            'nik' => 'NIK',
            'jk' => 'Jenis Kelamin',
            'tgl_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'rt' => 'RT',
            'rw' => 'RW',
            'posisi' => 'Posisi',
            'no_telp' => 'Nomor Telepon',
            'is_admin' => 'Admin', 
        ]);

        $validatedData['is_admin'] = $request->has('is_admin') ? true : false;

        User::create($validatedData);
        return redirect()->route('user.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $usia = Carbon::parse($user->tgl_lahir)->age;

        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Data Kader tidak ditemukan.');
        }
        return view('user.show', compact('user', 'usia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user = User::find($user->id);
        if (!$user->exists) {
            return redirect()->route('user.index')->with('error', 'Data Kader tidak ditemukan.');
        }
        return view('user.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'username' => 'nullable|string|max:255',
        'password' => ['nullable', 'string', Password::min(8)->mixedCase()->letters()->numbers()->symbols()],
        'nik' => 'required|string|digits:16|unique:users,nik,' . $id, 
        'nama' => 'required|string|max:255',
        'jk' => 'required|string',
        'tgl_lahir' => 'required|date',
        'alamat' => 'nullable|string|max:255',
        'rt' => 'nullable|string|max:3',
        'rw' => 'nullable|string|max:3',
        'posisi' => 'nullable|string',
        'no_telp' => 'nullable|string|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:10,13',
        'is_admin' => 'boolean', 
    ], [], [
        'nama' => 'Nama Lengkap',
        'nik' => 'NIK',
        'jk' => 'Jenis Kelamin',
        'tgl_lahir' => 'Tanggal Lahir',
        'alamat' => 'Alamat',
        'rt' => 'RT',
        'rw' => 'RW',
        'posisi' => 'Posisi',
        'no_telp' => 'Nomor Telepon',
        'is_admin' => 'Admin', 
    ]);

    $validatedData['is_admin'] = $request->has('is_admin') ? true : false;

    $user = User::find($id);
    $user->update($validatedData);

    if (!$user) {
        return redirect()->route('user.index')->with('error', 'Data Kader tidak ditemukan.');
    }

    return redirect()->route('user.show', $user->id)->with('success', 'Data berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus.');
    }

    public function filter(Request $request)
{
    $filter = $request->query('filter');
    $users = User::query();

    if ($filter === 'is_admin') {
        // jika admin
        $users->where('is_admin', true)
              ->whereIn('posisi', ['Admin', 'Ketua', 'Wakil Ketua', 'Sekertaris', 'Bendahara', 'Anggota']);
    } else {
        $users->whereIn('posisi', ['Ketua', 'Wakil Ketua', 'Sekertaris', 'Bendahara', 'Anggota']);
    }

    return response()->json($users->get());
}


}
