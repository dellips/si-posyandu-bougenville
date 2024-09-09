<?php

namespace App\Http\Controllers;

use App\Models\Ibu;
use App\Models\Anak;
use App\Models\Kegiatan;
use App\Models\Lansia;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $query = $request->input('q');
        
        $ibuResults = Ibu::where('nama', 'LIKE', "%{$query}%")
                          ->orWhere('nik', 'LIKE', "%{$query}%")
                          ->get();
        $anakResults = Anak::where('nama', 'LIKE', "%{$query}%")
                          ->orWhere('nik', 'LIKE', "%{$query}%")
                          ->get();
        $lansiaResults = Lansia::where('nama', 'LIKE', "%{$query}%")
                              ->orWhere('nik', 'LIKE', "%{$query}%")
                              ->get();
        $kegiatanResults = Kegiatan::select('nm_kegiatan as nama')
                              ->where('nm_kegiatan', 'LIKE', "%{$query}%")
                              ->get();
        $results = $ibuResults->merge($anakResults)->merge($lansiaResults)->merge($kegiatanResults);

        return view('search.index', compact('results'));
    }

    public function show(Request $request, $id)
    {
        $type = $request->input('type'); 
        $id = $request->input('id'); 

        switch ($type) {
            case 'ibu':
                $result = Ibu::find($id);
                break;
            case 'anak':
                $result = Anak::find($id);
                break;
            case 'lansia':
                $result = Lansia::find($id);
                break;
            case 'kegiatan':
                $result = Kegiatan::find($id);
                break;
            default:
                abort(404);
        }

        if (!$result) {
            return redirect()->route('search')->with('error', 'Data tidak ditemukan.');
        }

        return view("{$type}.show", compact('result'));
    }
}
