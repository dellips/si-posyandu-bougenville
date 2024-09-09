<x-layout>
    <x-slot:title>Bayi dan Balita</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <div class="flex items-center">
            <a href="/sasaran" class="px-4">
                <svg class="h-6 w-6 text-stone-400 hover:text-stone-800"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                    <path stroke="none" d="M0 0h24v24H0z"/>  
                    <line x1="5" y1="12" x2="19" y2="12" />  
                    <line x1="5" y1="12" x2="9" y2="16" />  
                    <line x1="5" y1="12" x2="9" y2="8" /></svg>
            </a>
            <p class="font-semibold text-lg uppercase text-violet-600">Form {{ isset($anak) ? 'Ubah' : 'Tambah' }} Data</p>
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

        <!-- alert berhasil -->
        @if (session('success'))   
        <div class="mt-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded" id="success-alert">
            <strong class="font-bold">{{ session('success') }}</strong>
        </div>   
        @endif

        <!-- garis -->
        <div class="divider"></div>

        <!-- form -->
        <form action="{{ isset($anak) ? route('anak.update', $anak->id) : route('anak.store') }}" method="POST" class="m-1 p-4 text-stone-800">
            @csrf
            @if(isset($anak))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label for="nik" class="block text-gray-800 font-semibold mb-2">NIK</label>
                <input type="text" id="nik" name="nik" value="{{ old('nik', isset($anak) ? $anak->nik : '') }}" placeholder="Masukkan NIK" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
            </div>
            <div class="mb-4">
                <label for="nama" class="block text-gray-800 font-semibold mb-2">Nama Lengkap Anak</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', isset($anak) ? $anak->nama : '') }}" placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">

            </div>
            <div class="mb-4">
                <label for="sasaran_id" class="block text-gray-800 font-semibold mb-2">Nama Ibu</label>
                <select name="sasaran_id" id="sasaran_id" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
                    <option value="">Pilih Nama Ibu</option>
                    @foreach ($sasaran as $sasaran)
                        <option value="{{ $sasaran->id }}" {{ isset($anak) && $anak->sasaran_id == $sasaran->id ? 'selected' : '' }}>
                            {{ $sasaran->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="nm_ayah" class="block text-gray-700 font-semibold mb-2">Nama Ayah</label>
                <input type="text" id="nm_ayah" name="nm_ayah" value="{{ old('nm_ayah', isset($anak) ? $anak->nm_ayah : '') }}" placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
            </div>
            <div class="flex flex-row mb-5">
                <div class="flex-initial w-1/3 mr-5">
                    <label for="tgl_lahir" class="block text-gray-800 font-semibold mb-2">Tanggal Lahir</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', isset($anak) ? $anak->tgl_lahir : '') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 text-gray-700 bg-white">
                </div>
            </div>
            <div class="mb-4">
                <label for="jk" class="block text-gray-800 font-semibold mb-2">Jenis Kelamin</label>
                <select id="jk" name="jk" class="w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
                    <option value="" disabled {{ old('jk', isset($anak)) ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki" {{ old('jk', isset($anak) && $anak->jk) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('jk', isset($anak) && $anak->jk) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="flex flex-row mb-4">
                <div class="flex-initial w-1/2">
                    <label for="bb_lahir" class="block text-gray-800 font-semibold mb-2">Berat Badan Lahir</label>
                    <input type="text" id="bb_lahir" name="bb_lahir" value="{{ old('bb_lahir', isset($anak) ? $anak->bb_lahir : '') }}" placeholder="000.0" class="w-1/2 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
                     kg
                </div>
                <div class="flex-initial w-1/2">
                    <label for="tb_lahir" class="block text-gray-800 font-semibold mb-2">Tinggi Badan Lahir</label>
                    <input type="text" id="tb_lahir" name="tb_lahir" value="{{ old('tb_lahir', isset($anak) ? $anak->tb_lahir : '') }}" placeholder="000.0" class="w-1/2 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
                     cm
                </div>
            </div>
            <div class="flex flex-row mb-4">
                <div class="flex-initial w-1/2">
                    <label for="jns_persalinan" class="block text-gray-800 font-semibold mb-2">Jenis Persalinan</label>
                    <select id="jns_persalinan" name="jns_persalinan" class="w-1/2 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
                        <option value="" disabled {{ old('jns_persalinan', isset($anak)) ? '' : 'selected' }}>Pilih Jenis Persalinan</option>
                        <option value="Spontan" {{ old('jns_persalinan', isset($anak) && $anak->jns_persalinan) == 'Spontan' ? 'selected' : '' }}>Spontan</option>
                        <option value="Sesar" {{ old('jns_persalinan', isset($anak) && $anak->jns_persalinan) === 'Sesar' ? 'selected' : '' }}>Sesar</option>
                    </select>
                </div>
                <div class="flex-initial w-1/2">
                    <label for="jns_kelahiran" class="block text-gray-800 font-semibold mb-2">Jenis Kelahian</label>
                    <select id="jns_kelahiran" name="jns_kelahiran" class="w-1/2 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
                        <option value="" disabled {{ old('jns_persalinan', isset($anak)) ? '' : 'selected' }}>Pilih Jenis Kelahiran</option>
                        <option value="Normal" {{ old('jns_persalinan', isset($anak) && $anak->jns_persalinan) == 'Normal' ? 'selected' : '' }}>Normal</option>
                        <option value="Prematur" {{ old('jns_persalinan', isset($anak) && $anak->jns_persalinan) === 'Prematur' ? 'selected' : '' }}>Prematur</option>
                    </select>
                </div>
            </div>
        
            <div class="flex justify-end mt-6 mr-4">
                <button type="submit" class="px-10 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600">{{ isset($anak) ? 'Ubah' : 'Simpan' }}</button>
            </div>
        </form>
    </section>
</x-layout>

<script>
    document.addEventListener('DOMContentLoaded', function () {
      var successAlert = document.getElementById('success-alert');
          
      if (successAlert) {
        successAlert.classList.remove('hidden'); 
              
        setTimeout(function () {
          successAlert.style.transition = "opacity 0.5s ease-out"; 
          successAlert.style.opacity = "0"; 
          setTimeout(function() {
            successAlert.remove(); 
          }, 500); 
        }, 5000); 
      }
    });
  </script>

    