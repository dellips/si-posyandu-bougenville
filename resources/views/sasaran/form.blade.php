<x-layout>
    <x-slot:title>Sasaran Posyandu</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <div class="flex items-center">
            <a href="/sasaran" class="px-4">
                <svg class="h-6 w-6 text-stone-400 hover:text-stone-800"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                    <path stroke="none" d="M0 0h24v24H0z"/>  
                    <line x1="5" y1="12" x2="19" y2="12" />  
                    <line x1="5" y1="12" x2="9" y2="16" />  
                    <line x1="5" y1="12" x2="9" y2="8" /></svg>
            </a>
            <p class="font-semibold text-lg uppercase text-violet-600">Form {{ isset($sasaran) ? 'Ubah' : 'Tambah' }} Data</p>
        </div>
        
        <!-- alert error -->
        @if ($errors->any())
        <div class="mt-4 bg-red-100 border border-red-600 text-red-700 px-4 py-3 rounded" role="alert">
            <strong class="font-bold">Terdapat kesalahan!</strong>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- garis -->
        <div class="divider"></div>

        <!-- form -->
        <form action="{{ isset($sasaran) ? route('sasaran.update', $sasaran->id) : route('sasaran.store') }}" method="POST" class="m-1 p-4 text-stone-800">
            @csrf
            @if(isset($sasaran))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label for="kategori" class="block text-gray-800 font-semibold mb-2">Kategori</label>
                <select id="kategori" name="kategori" class="w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
                    <option value="" disabled {{ old('kategori', isset($sasaran) ? '' : 'selected') }}>Pilih Kategori</option>
                    <option value="Ibu Hamil" {{ old('kategori', (isset($sasaran) && $sasaran->kategori === 'Ibu Hamil') ? 'selected' : '') }}>Ibu Hamil</option>
                    <option value="Ibu" {{ old('kategori', (isset($sasaran) && $sasaran->kategori === 'Ibu') ? 'selected' : '') }}>Ibu</option>
                    <option value="Lansia" {{ old('kategori', (isset($sasaran) && $sasaran->kategori === 'Lansia') ? 'selected' : '') }}>Lansia</option>
                </select> 
            </div>
            <div class="mb-4 ">
                <label for="nik" class="block font-semibold mb-2">NIK</label>
                <input type="text" id="nik" value="{{ isset($sasaran) ? $sasaran->nik : old('nik') }}" name="nik" placeholder="Masukkan NIK" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500 bg-white">
            </div>
            <div class="mb-4 ">
                <label for="nama" class="block font-semibold mb-2">Nama Lengkap</label>
                <input type="text" id="nama" value="{{ isset($sasaran) ? $sasaran->nama : old('nama') }}" name="nama" placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-purple-500 bg-white">
            </div>
            <div class="mb-4">
                <label for="jk" class="block font-semibold mb-2">Jenis Kelamin</label>
                <select id="jk" name="jk" class="w-1/3 px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
                    <option value="" disabled {{ old('jk', isset($sasaran)) ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki" {{ old('jk', isset($sasaran) && $sasaran->jk == 'Laki-Laki') ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('jk', isset($sasaran) && $sasaran->jk == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="tgl_lahir" class="block font-semibold mb-2">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ isset($sasaran) ? $sasaran->tgl_lahir : old('tgl_lahir') }}" class="w-1/4 px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500 text-gray-700">
            </div>
            <div class="flex flex-row mb-4">
                <div class="flex-initial w-1/3 mr-5">
                    <label for="alamat" class="block font-semibold mb-2">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ isset($sasaran) ? $sasaran->alamat : old('alamat') }}" placeholder="Masukkan Alamat" class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
                </div>
                <div class="flex-none w-14 mr-5">
                    <label for="rt" class="block font-semibold mb-2">RT</label>
                    <input type="text" id="rt" name="rt" value="{{ isset($sasaran) ? $sasaran->rt : old('rt') }}" placeholder="00" class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
                </div>
                <div class="flex-none w-14 mr-5">
                    <label for="rw" class="block font-semibold mb-2">RW</label>
                    <input type="text" id="rw" name="rw" value="{{ isset($sasaran) ? $sasaran->rw : old('rw') }}" placeholder="00" class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
                </div>
            </div>
            <div class="mb-4">
                <label for="no_telp" class="block0 font-semibold mb-2">Nomor Telepon</label>
                <input type="text" id="no_telp" name="no_telp" value="{{ isset($sasaran) ? $sasaran->no_telp : old('no_telp') }}" placeholder="Masukkan Nomor Telepon" class="w-full px-4 py-2 border rounded-lg bg-white focus:outline-none focus:border-purple-500">
            </div>
            <div class="mb-4">
                <label for="status_bpjs" class="block text-gray-800 font-semibold mb-2">Status BPJS</label>
                <select id="status_bpjs" name="status_bpjs" class="w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
                    <option value="" disabled {{ old('status_bpjs', isset($sasaran) ? '' : 'selected') }}>Pilih Status BPJS</option>
                    <option value="Aktif" {{ old('status_bpjs', (isset($sasaran) && $sasaran->status_bpjs === 'Aktif') ? 'selected' : '') }}>Aktif</option>
                    <option value="Tidak Aktif" {{ old('status_bpjs', (isset($sasaran) && $sasaran->status_bpjs === 'Tidak Aktif') ? 'selected' : '') }}>Tidak Aktif</option>
                </select> 
            </div>
            <div class="flex justify-end mt-6 mr-4">
                <button type="submit" class="btn btn-primary px-5 py-1 text-white flex items-center">
                    <svg class="h-4 w-4 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                        <path stroke="none" d="M0 0h24v24H0z"/>  
                        <path d="M5 12l5 5l10 -10" /></svg>
                    <span>{{ isset($user) ? 'Ubah' : 'Simpan' }}</span>
                </button>
            </div>
        </form>
    </section>
</x-layout>

<script>
    document.getElementById('kategori').addEventListener('change', function () {
    var kategori = this.value;
    var jkSelect = document.getElementById('jk');
    
    // Reset jenis kelamin dropdown
    jkSelect.selectedIndex = 0;
    
    // Menonaktifkan opsi "Laki-Laki" jika kategori adalah "Ibu Hamil" atau "Ibu"
    for (var i = 0; i < jkSelect.options.length; i++) {
        var option = jkSelect.options[i];
        if ((kategori === 'Ibu Hamil' || kategori === 'Ibu') && option.value === 'Laki-Laki') {
            option.disabled = true;
        } else {
            option.disabled = false;
        }
    }
});


  </script>