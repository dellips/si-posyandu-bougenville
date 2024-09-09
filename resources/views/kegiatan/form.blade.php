<x-layout>
    <x-slot:title>Kegiatan Posyandu</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <div class="flex items-center">
            <a href="/kegiatan" class="px-4">
                <svg class="h-6 w-6 text-stone-400 hover:text-stone-800"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                    <path stroke="none" d="M0 0h24v24H0z"/>  
                    <line x1="5" y1="12" x2="19" y2="12" />  
                    <line x1="5" y1="12" x2="9" y2="16" />  
                    <line x1="5" y1="12" x2="9" y2="8" /></svg>
            </a>
            <p class="font-semibold text-lg uppercase text-violet-600">Form {{ isset($user) ? 'Ubah' : 'Tambah' }} Kegiatan</p>
        </div>

        <!-- alert error -->
        @if ($errors->any())
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
            <strong class="font-bold">Terdapat kesalahan!</strong>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- form -->
        <form action="{{ isset($kegiatan) ? route('kegiatan.update', $kegiatan->id) : route('kegiatan.store') }}" method="POST" class="m-1 p-4 text-stone-800">
            @csrf
            @if (isset($kegiatan))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label for="nm_kegiatan" class="block text-gray-800 font-semibold mb-2">Nama Kegiatan</label>
                <input type="text" id="nm_kegiatan" name="nm_kegiatan" value="{{ old('nm_kegiatan', isset($kegiatan) ? $kegiatan->nm_kegiatan : '') }}" placeholder="Masukkan Nama Kegiatan" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
            </div>
            <div class="mb-4">
                <label for="tgl_kegiatan" class="block text-gray-800 font-semibold mb-2">Tanggal Kegiatan</label>
                <input type="date" id="tgl_kegiatan" name="tgl_kegiatan" value="{{ old('tgl_kegiatan', isset($kegiatan) ? $kegiatan->tgl_kegiatan : '') }}" class="w-1/4 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 text-gray-700 bg-white">
            </div>
            <div class="mb-4">
                <label for="ket" class="block text-gray-800 font-semibold mb-2">Keterangan</label>
                <input type="text" id="ket" name="ket" value="{{ old('ket', isset($kegiatan) ? $kegiatan->ket : '') }}" placeholder="Masukan Keterangan" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
            </div>
            <div class="flex justify-end mt-6 mr-4">
                <button type="submit" class="btn btn-primary px-5 py-1 text-white flex items-center">
                  <svg class="h-4 w-4 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                    <path stroke="none" d="M0 0h24v24H0z"/>  
                    <path d="M5 12l5 5l10 -10" /></svg>
                  <span>{{ isset($kegiatan) ? 'Ubah' : 'Simpan' }}</span>
                </button>
            </div>
        </form>
    </section>
</x-layout>