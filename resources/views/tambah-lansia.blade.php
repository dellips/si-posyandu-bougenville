<x-layout>
    <x-slot:title>Data Lansia</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <p class="font-semibold text-lg uppercase text-purple-800">Form {{ isset($lansia) ? 'Ubah' : 'Tambah' }} Data</p>
        
        <!-- alert error -->
        @if ($errors->any())
        <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded absolute" role="alert">
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

        <!-- form -->
        <form action="{{ isset($lansia) ? route('lansia.update', $lansia->id) : route('lansia.store') }}" method="POST" class="m-1 p-4">
            @csrf
            @if(isset($lansia))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label for="nik" class="block text-gray-700 font-semibold mb-2">NIK</label>
                <input type="text" id="nik" value="{{old('nik', $lansia->nik ?? '') }}" name="nik" placeholder="Masukkan NIK" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:purple-green-500">
            </div>
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" id="nama" value="{{ old('nama', isset($lansia) ? $lansia->nama : '') }}" name="nama" placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
            </div>
            <div class="mb-4">
                <label for="tgl_lahir" class="block text-gray-700 font-semibold mb-2">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', isset($lansia) ? $lansia->tgl_lahir : '') }}" class="w-1/4 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 text-gray-700">
            </div>
            <div class="flex flex-row mb-4">
                <div class="flex-initial w-1/3 mr-5">
                    <label for="alamat" class="block text-gray-800 font-semibold mb-2">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ old('alamat', isset($lansia) ? $lansia->alamat : '') }}" placeholder="Masukkan Alamat" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                </div>
                <div class="flex-none w-14 mr-5">
                    <label for="rt" class="block text-gray-800 font-semibold mb-2">RT</label>
                    <input type="text" id="rt" name="rt" value="{{ old('rt', isset($lansia) ? $lansia->rt : '') }}" placeholder="00" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                </div>
                <div class="flex-none w-14 mr-5">
                    <label for="rw" class="block text-gray-800 font-semibold mb-2">RW</label>
                    <input type="text" id="rw" name="rw" value="{{ old('rw', isset($lansia) ? $lansia->rw : '') }}" placeholder="00" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
                </div>
            </div>
            <div class="mb-4">
                <label for="no_telp" class="block text-gray-700 font-semibold mb-2">Nomor Telepon</label>
                <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp', isset($lansia) ? $lansia->no_telp : '') }}" placeholder="Masukkan Nomor Telepon" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500">
            </div>
            <div class="mb-4">
                <label for="bpjs" class="block text-gray-800 font-semibold mb-2">Kepunyaan BPJS</label>
                <select id="bpjs" name="bpjs" class="w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 text-gray-700">
                    <option value="" disabled {{ old('bpjs', isset($lansia) ? '' : 'selected') }}>Pilih Kepunyaan BPJS</option>
                    <option value="Ada" {{ old('bpjs', (isset($lansia) && $lansia->bpjs === 'Ada') ? 'selected' : '') }}>Ada</option>
                    <option value="Tidak Ada" {{ old('bpjs', (isset($lansia) && $lansia->bpjs === 'Tidak Ada') ? 'selected' : '') }}>Tidak Ada</option>
                </select> 
            </div>
            <div class="flex justify-end mt-6 mr-4">
                <button type="submit" class="px-10 py-2 bg-purple-500 text-white rounded-md hover:bg-purple-600">{{ isset($lansia) ? 'Ubah' : 'Simpan' }}</button>
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