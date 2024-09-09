<x-layout>
    <x-slot:title>Pemeriksaan PTM</x-slot:title>
    <section class="m-1 p-8 rounded-lg bg-white">
        <div class="flex items-center">
            <a href="/pemeriksaan" class="px-4">
                <svg class="h-6 w-6 text-stone-400 hover:text-stone-800"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                    <path stroke="none" d="M0 0h24v24H0z"/>  
                    <line x1="5" y1="12" x2="19" y2="12" />  
                    <line x1="5" y1="12" x2="9" y2="16" />  
                    <line x1="5" y1="12" x2="9" y2="8" /></svg>
            </a>
            <p class="font-semibold text-lg uppercase text-violet-600">Form {{ isset($pemeriksaan) ? 'Ubah' : 'Tambah' }} Akun</p>
        </div>

        <!-- alert error -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Ada kesalahan!</strong>
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- garis -->
        <div class="divider"></div>
        
        
        <!-- Kategori -->
        <div class="flex items-center space-x-4">
            <h3 class="font-semibold text-md text-stone-600">Kategori</h3>
            <select id="kategoriDropdown" class="select select-bordered select-primary bg-transparent text-stone-800">
              <option value="" selected disabled >-- Pilih --</option>
              <option value="Ibu Hamil">Ibu Hamil</option>
              <option value="Ibu">Ibu</option>
              <option value="Anak">Bayi dan Balita</option>
              <option value="Lansia">Lansia</option>
            </select>
        </div>

        <!-- form untuk ibu hamil-->
        <div id="formIbuHamil" class="mt-4 form-category hidden">
            <form action="{{ isset($pemeriksaan) ? route('pemeriksaan.update', $pemeriksaan->id) : route('pemeriksaan.store') }}" method="POST" class="m-1 p-4">
                @csrf
                @if (isset($pemeriksaan))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="kegiatan_id" class="block text-gray-800 font-semibold mb-2">Nama Kegiatan</label>
                    <select name="kegiatan_id" id="kegiatan_id" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="">Pilih Nama Kegiatan</option>
                        @foreach ($kegiatan as $kegiatanItem)
                            <option value="{{ $kegiatanItem->id }}" {{ old('kegiatan_id', isset($pemeriksaan) ? $pemeriksaan->kegiatan_id : '') == $kegiatanItem->id ? 'selected' : '' }}>
                                {{ $kegiatanItem->nm_kegiatan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="sasaran_id" class="block text-gray-800 font-semibold mb-2">Nama Ibu Hamil</label>
                    <select name="sasaran_id" id="sasaran_id" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="">Pilih Nama Ibu Hamil</option>
                        @foreach ($ibuHamil as $itemIbuHamil)
                            <option value="{{ $itemIbuHamil->id }}" {{ old('sasaran_id', isset($pemeriksaan) ? $pemeriksaan->sasaran_id : '') == $itemIbuHamil->id ? 'selected' : '' }}>
                                {{ $itemIbuHamil->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <div class="flex-initial w-1/2">
                        <label for="bulan_ke" class="block text-gray-800 font-semibold mb-2">Usia Kehamilan</label>
                        <input type="text" id="bulan_ke" name="bulan_ke" value="{{ old('bulan_ke', isset($pemeriksaan) ? $pemeriksaan->bulan_ke : '') }}" placeholder="Masukan Usia Kehamilan" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                    </div>
                </div>

                <div class="flex flex-row mb-4">
                    <div class="flex-initial w-1/2">
                        <label for="bb" class="block text-gray-800 font-semibold mb-2">Berat Badan</label>
                        <input type="text" id="bb" name="bb" value="{{ old('bb', isset($pemeriksaan) ? $pemeriksaan->bb : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-50">
                         kg
                    </div>
                    <div class="flex-initial w-1/2">
                        <label for="tb" class="block text-gray-800 font-semibold mb-2">Tinggi Badan</label>
                        <input type="text" id="tb" name="tb" value="{{ old('tb', isset($pemeriksaan) ? $pemeriksaan->tb : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                         cm
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex-initial w-1/2">
                        <label for="lp" class="block text-gray-800 font-semibold mb-2">Lingkar Pinggul</label>
                        <input type="text" id="lp" name="lp" value="{{ old('lp', isset($pemeriksaan) ? $pemeriksaan->lp : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                         cm
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex-initial w-1/2 mr-5">
                        <label for="sistolik" class="block text-gray-800 font-semibold mb-2">Tekanan Darah</label>
                        <div class="flex items-center">
                            <input type="text" id="sistolik" name="sistolik" value="{{ old('sistolik', isset($pemeriksaan) ? $pemeriksaan->sistolik : '') }}" placeholder="000" class="w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                            <span class="mx-2">/</span>
                            <input type="text" id="diastolik" name="diastolik" value="{{ old('diastolik', isset($pemeriksaan) ? $pemeriksaan->diastolik : '') }}" placeholder="000" class="w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        </div>
                    </div>                    
                </div>

                <div class="mb-4">
                    <label for="vit_a" class="block text-gray-800 font-semibold mb-2">Vitamin A</label>
                    <select id="vit_a" name="vit_a" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="" disabled {{ old('vit_a', isset($pemeriksaan) ? '' : 'selected') }}>Pilih Pemberian Vitamin A</option>
                        <option value="Tidak diberikan" {{ old('vit_a', isset($pemeriksaan) ? $pemeriksaan->vit_a : '') == 'Tidak diberikan' ? 'selected' : '' }}>Tidak diberikan</option>
                        <option value="Kapsul Merah" {{ old('vit_a', isset($pemeriksaan) ? $pemeriksaan->vit_a : '') == 'Kapsul Merah' ? 'selected' : '' }}>Kapsul Merah</option>
                        <option value="Kapsul Biru" {{ old('vit_a', isset($pemeriksaan) ? $pemeriksaan->vit_a : '') == 'Kapsul Biru' ? 'selected' : '' }}>Kapsul Biru</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tambah_darah" class="block text-gray-800 font-semibold mb-2">Suplemen Penambah Darah</label>
                    <select id="tambah_darah" name="tambah_darah" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="" disabled {{ old('tambah_darah', isset($pemeriksaan) ? '' : 'selected') }}>Pilih Pemberian Suplemen Penambah Darah</option>
                        <option value="Tidak diberikan" {{ old('tambah_darah', isset($pemeriksaan) ? $pemeriksaan->tambah_darah : '') == 'Tidak diberikan' ? 'selected' : '' }}>Tidak diberikan</option>
                        <option value="Diberikan" {{ old('tambah_darah', isset($pemeriksaan) ? $pemeriksaan->tambah_darah : '') == 'Diberikan' ? 'selected' : '' }}>Diberikan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="ket" class="block text-gray-800 font-semibold mb-2">Keterangan</label>
                    <textarea id="ket" name="ket" rows="3" placeholder="Keterangan tambahan..." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">{{ old('ket', isset($pemeriksaan) ? $pemeriksaan->keterangan : '') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary px-5 py-1 text-white flex items-center">
                        <svg class="h-4 w-4 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                            <path stroke="none" d="M0 0h24v24H0z"/>  
                            <path d="M5 12l5 5l10 -10" /></svg>
                        <span>{{ isset($pemeriksaan) ? 'Ubah' : 'Simpan' }}</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- form untuk ibu -->
        <div id="formIbu" class="mt-4 form-category hidden">
            <form action="{{ isset($pemeriksaan) ? route('pemeriksaan.update', $pemeriksaan->id) : route('pemeriksaan.store') }}" method="POST" class="m-1 p-4">
                @csrf
                @if (isset($pemeriksaan))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="kegiatan_id" class="block text-gray-800 font-semibold mb-2">Nama Kegiatan</label>
                    <select name="kegiatan_id" id="kegiatan_id" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="">Pilih Nama Kegiatan</option>
                        @foreach ($kegiatan as $kegiatanItem)
                            <option value="{{ $kegiatanItem->id }}" {{ old('kegiatan_id', isset($pemeriksaan) ? $pemeriksaan->kegiatan_id : '') == $kegiatanItem->id ? 'selected' : '' }}>
                                {{ $kegiatanItem->nm_kegiatan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="sasaran_id" class="block text-gray-800 font-semibold mb-2">Nama Ibu</label>
                    <select name="sasaran_id" id="sasaran_id" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="">Pilih Nama Ibu</option>
                        @foreach ($ibu as $itemIbu)
                            <option value="{{ $itemIbu->id }}" {{ old('sasaran_id', isset($pemeriksaan) ? $pemeriksaan->sasaran_id : '') == $itemIbu->id ? 'selected' : '' }}>
                                {{ $itemIbu->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-row mb-4">
                    <div class="flex-initial w-1/2">
                        <label for="bb" class="block text-gray-800 font-semibold mb-2">Berat Badan</label>
                        <input type="text" id="bb" name="bb" value="{{ old('bb', isset($pemeriksaan) ? $pemeriksaan->bb : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-50">
                         kg
                    </div>
                    <div class="flex-initial w-1/2">
                        <label for="tb" class="block text-gray-800 font-semibold mb-2">Tinggi Badan</label>
                        <input type="text" id="tb" name="tb" value="{{ old('tb', isset($pemeriksaan) ? $pemeriksaan->tb : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                         cm
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex-initial w-1/2">
                        <label for="lp" class="block text-gray-800 font-semibold mb-2">Lingkar Pinggul</label>
                        <input type="text" id="lp" name="lp" value="{{ old('lp', isset($pemeriksaan) ? $pemeriksaan->lp : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                         cm
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex-initial w-1/2 mr-5">
                        <label for="sistolik" class="block text-gray-800 font-semibold mb-2">Tekanan Darah</label>
                        <div class="flex items-center">
                            <input type="text" id="sistolik" name="sistolik" value="{{ old('sistolik', isset($pemeriksaan) ? $pemeriksaan->sistolik : '') }}" placeholder="000" class="w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                            <span class="mx-2">/</span>
                            <input type="text" id="diastolik" name="diastolik" value="{{ old('diastolik', isset($pemeriksaan) ? $pemeriksaan->diastolik : '') }}" placeholder="000" class="w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        </div>
                    </div>                    
                </div>

                <div class="mb-4">
                    <label for="vit_a" class="block text-gray-800 font-semibold mb-2">Vitamin A</label>
                    <select id="vit_a" name="vit_a" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="" disabled {{ old('vit_a', isset($pemeriksaan) ? '' : 'selected') }}>Pilih Pemberian Vitamin A</option>
                        <option value="Tidak diberikan" {{ old('vit_a', isset($pemeriksaan) ? $pemeriksaan->vit_a : '') == 'Tidak diberikan' ? 'selected' : '' }}>Tidak diberikan</option>
                        <option value="Kapsul Merah" {{ old('vit_a', isset($pemeriksaan) ? $pemeriksaan->vit_a : '') == 'Kapsul Merah' ? 'selected' : '' }}>Kapsul Merah</option>
                        <option value="Kapsul Biru" {{ old('vit_a', isset($pemeriksaan) ? $pemeriksaan->vit_a : '') == 'Kapsul Biru' ? 'selected' : '' }}>Kapsul Biru</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="tambah_darah" class="block text-gray-800 font-semibold mb-2">Suplemen Penambah Darah</label>
                    <select id="tambah_darah" name="tambah_darah" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="" disabled {{ old('tambah_darah', isset($pemeriksaan) ? '' : 'selected') }}>Pilih Pemberian Suplemen Penambah Darah</option>
                        <option value="Tidak diberikan" {{ old('tambah_darah', isset($pemeriksaan) ? $pemeriksaan->tambah_darah : '') == 'Tidak diberikan' ? 'selected' : '' }}>Tidak diberikan</option>
                        <option value="Diberikan" {{ old('tambah_darah', isset($pemeriksaan) ? $pemeriksaan->tambah_darah : '') == 'Diberikan' ? 'selected' : '' }}>Diberikan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="ket" class="block text-gray-800 font-semibold mb-2">Keterangan</label>
                    <textarea id="ket" name="ket" rows="3" placeholder="Keterangan tambahan..." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">{{ old('ket', isset($pemeriksaan) ? $pemeriksaan->keterangan : '') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary px-5 py-1 text-white flex items-center">
                        <svg class="h-4 w-4 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                            <path stroke="none" d="M0 0h24v24H0z"/>  
                            <path d="M5 12l5 5l10 -10" /></svg>
                        <span>{{ isset($pemeriksaan) ? 'Ubah' : 'Simpan' }}</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- form untuk anak -->
        <div id="formAnak" class="mt-4 form-category hidden">
            <form action="{{ isset($pemeriksaan) ? route('pemeriksaan.update', $pemeriksaan->id) : route('pemeriksaan.store') }}" method="POST" class="m-1 p-4">
                @csrf
                @if (isset($pemeriksaan))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="kegiatan_id" class="block text-gray-800 font-semibold mb-2">Nama Kegiatan</label>
                    <select name="kegiatan_id" id="kegiatan_id" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="">Pilih Nama Kegiatan</option>
                        @foreach ($kegiatan as $kegiatanItem)
                            <option value="{{ $kegiatanItem->id }}" {{ old('kegiatan_id', isset($pemeriksaan) ? $pemeriksaan->kegiatan_id : '') == $kegiatanItem->id ? 'selected' : '' }}>
                                {{ $kegiatanItem->nm_kegiatan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="anak_id" class="block text-gray-800 font-semibold mb-2">Nama Anak</label>
                    <select name="anak_id" id="anak_id" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="">Pilih Nama Anak</option>
                        @foreach ($anak as $anak)
                            <option value="{{ $anak->id }}" {{ old('anak_id', isset($pemeriksaan) ? $pemeriksaan->anak_id : '') == $anak->id ? 'selected' : '' }}>
                                {{ $anak->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-row mb-4">
                    <div class="flex-initial w-1/2">
                        <label for="bb" class="block text-gray-800 font-semibold mb-2">Berat Badan</label>
                        <input type="text" id="bb" name="bb" value="{{ old('bb', isset($pemeriksaan) ? $pemeriksaan->bb : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-50">
                         kg
                    </div>
                    <div class="flex-initial w-1/2">
                        <label for="tb" class="block text-gray-800 font-semibold mb-2">Tinggi Badan</label>
                        <input type="text" id="tb" name="tb" value="{{ old('tb', isset($pemeriksaan) ? $pemeriksaan->tb : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                         cm
                    </div>
                </div>

                <div class="flex flex-row mb-4">
                    <div class="flex-initial w-1/2">
                        <label for="pl" class="block text-gray-800 font-semibold mb-2">Panjang Lengan Atas</label>
                        <input type="text" id="pl" name="pl" value="{{ old('pl', isset($pemeriksaan) ? $pemeriksaan->pl : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-50">
                         kg
                    </div>
                    <div class="flex-initial w-1/2">
                        <label for="lila" class="block text-gray-800 font-semibold mb-2">Lingkar Lengan</label>
                        <input type="text" id="lila" name="lila" value="{{ old('lila', isset($pemeriksaan) ? $pemeriksaan->lila : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                         cm
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex-initial w-1/2">
                        <label for="lk" class="block text-gray-800 font-semibold mb-2">Lingkar Kepala</label>
                        <input type="text" id="lk" name="lk" value="{{ old('lk', isset($pemeriksaan) ? $pemeriksaan->lp : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                         cm
                    </div>
                </div>

                <div class="mb-4">
                    <label for="vit_a" class="block text-gray-800 font-semibold mb-2">Vitamin A</label>
                    <select id="vit_a" name="vit_a" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="" disabled {{ old('vit_a', isset($pemeriksaan) ? '' : 'selected') }}>Pilih Pemberian Vitamin A</option>
                        <option value="Tidak diberikan" {{ old('vit_a', isset($pemeriksaan) ? $pemeriksaan->vit_a : '') == 'Tidak diberikan' ? 'selected' : '' }}>Tidak diberikan</option>
                        <option value="Kapsul Merah" {{ old('vit_a', isset($pemeriksaan) ? $pemeriksaan->vit_a : '') == 'Kapsul Merah' ? 'selected' : '' }}>Kapsul Merah</option>
                        <option value="Kapsul Biru" {{ old('vit_a', isset($pemeriksaan) ? $pemeriksaan->vit_a : '') == 'Kapsul Biru' ? 'selected' : '' }}>Kapsul Biru</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="obat_cacing" class="block text-gray-800 font-semibold mb-2">Obat Cacing</label>
                    <select id="obat_cacing" name="obat_cacing" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="" disabled {{ old('obat_cacing', isset($pemeriksaan) ? '' : 'selected') }}>Pilih Pemberian Obat Cacing</option>
                        <option value="Tidak diberikan" {{ old('obat_cacing', isset($pemeriksaan) ? $pemeriksaan->obat_cacing : '') == 'Tidak diberikan' ? 'selected' : '' }}>Tidak diberikan</option>
                        <option value="Diberikan" {{ old('obat_cacing', isset($pemeriksaan) ? $pemeriksaan->obat_cacing : '') == 'Diberikan' ? 'selected' : '' }}>Diberikan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="ket" class="block text-gray-800 font-semibold mb-2">Keterangan</label>
                    <textarea id="ket" name="ket" rows="3" placeholder="Keterangan tambahan..." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">{{ old('ket', isset($pemeriksaan) ? $pemeriksaan->keterangan : '') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary px-5 py-1 text-white flex items-center">
                        <svg class="h-4 w-4 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                            <path stroke="none" d="M0 0h24v24H0z"/>  
                            <path d="M5 12l5 5l10 -10" /></svg>
                        <span>{{ isset($pemeriksaan) ? 'Ubah' : 'Simpan' }}</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- form untuk lansia -->
        <div id="formLansia" class="mt-4 form-category hidden">
            <form action="{{ isset($pemeriksaan) ? route('pemeriksaan.update', $pemeriksaan->id) : route('pemeriksaan.store') }}" method="POST" class="m-1 p-4">
                @csrf
                @if (isset($pemeriksaan))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="kegiatan_id" class="block text-gray-800 font-semibold mb-2">Nama Kegiatan</label>
                    <select name="kegiatan_id" id="kegiatan_id" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="">Pilih Nama Kegiatan</option>
                        @foreach ($kegiatan as $kegiatanItem)
                            <option value="{{ $kegiatanItem->id }}" {{ old('kegiatan_id', isset($pemeriksaan) ? $pemeriksaan->kegiatan_id : '') == $kegiatanItem->id ? 'selected' : '' }}>
                                {{ $kegiatanItem->nm_kegiatan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="sasaran_id" class="block text-gray-800 font-semibold mb-2">Nama Lansia</label>
                    <select name="sasaran_id" id="sasaran_id" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        <option value="">Pilih Nama Lansia</option>
                        @foreach ($lansia as $itemLansia)
                            <option value="{{ $itemLansia->id }}" {{ old('sasaran_id', isset($pemeriksaan) ? $pemeriksaan->sasaran_id : '') == $itemLansia->id ? 'selected' : '' }}>
                                {{ $itemLansia->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-row mb-4">
                    <div class="flex-initial w-1/2">
                        <label for="bb" class="block text-gray-800 font-semibold mb-2">Berat Badan</label>
                        <input type="text" id="bb" name="bb" value="{{ old('bb', isset($pemeriksaan) ? $pemeriksaan->bb : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-50">
                         kg
                    </div>
                    <div class="flex-initial w-1/2">
                        <label for="tb" class="block text-gray-800 font-semibold mb-2">Tinggi Badan</label>
                        <input type="text" id="tb" name="tb" value="{{ old('tb', isset($pemeriksaan) ? $pemeriksaan->tb : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                         cm
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex-initial w-1/2">
                        <label for="lp" class="block text-gray-800 font-semibold mb-2">Lingkar Perut</label>
                        <input type="text" id="lp" name="lp" value="{{ old('lp', isset($pemeriksaan) ? $pemeriksaan->lp : '') }}" placeholder="000.0" class="w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                         cm
                    </div>
                </div>

                <div class="mb-4">
                    <div class="flex-initial w-1/2 mr-5">
                        <label for="sistolik" class="block text-gray-800 font-semibold mb-2">Tekanan Darah</label>
                        <div class="flex items-center">
                            <input type="text" id="sistolik" name="sistolik" value="{{ old('sistolik', isset($pemeriksaan) ? $pemeriksaan->sistolik : '') }}" placeholder="000" class="w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                            <span class="mx-2">/</span>
                            <input type="text" id="diastolik" name="diastolik" value="{{ old('diastolik', isset($pemeriksaan) ? $pemeriksaan->diastolik : '') }}" placeholder="000" class="w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                        </div>
                    </div>                    
                </div>

                <div class="mb-4">
                    <label for="ket" class="block text-gray-800 font-semibold mb-2">Keterangan</label>
                    <textarea id="ket" name="ket" rows="3" placeholder="Keterangan tambahan..." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">{{ old('ket', isset($pemeriksaan) ? $pemeriksaan->keterangan : '') }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="btn btn-primary px-5 py-1 text-white flex items-center">
                        <svg class="h-4 w-4 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                            <path stroke="none" d="M0 0h24v24H0z"/>  
                            <path d="M5 12l5 5l10 -10" /></svg>
                        <span>{{ isset($pemeriksaan) ? 'Ubah' : 'Simpan' }}</span>
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layout>

<script>
    const kategoriDropdown = document.getElementById('kategoriDropdown');
    const formIbuHamil = document.getElementById('formIbuHamil');
    const formIbu = document.getElementById('formIbu');
    const formAnak = document.getElementById('formAnak');
    const formLansia = document.getElementById('formLansia');

    kategoriDropdown.addEventListener('change', function() {
        // Hide all forms first
        document.querySelectorAll('.form-category').forEach(form => form.classList.add('hidden'));
        
        // Show the selected category form
        const selectedCategory = kategoriDropdown.value;
        if (selectedCategory === 'Ibu Hamil') {
            formIbuHamil.classList.remove('hidden');
        } else if (selectedCategory === 'Ibu') {
            formIbu.classList.remove('hidden');
        } else if (selectedCategory === 'Anak') {
            formAnak.classList.remove('hidden');
        } else if (selectedCategory === 'Lansia') {
            formLansia.classList.remove('hidden');
        }
    });
</script>


