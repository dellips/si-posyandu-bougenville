<x-layout>
    <x-slot:title>Data Anak</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <p class="font-semibold text-lg uppercase text-green-600">Form {{ isset($anak) ? 'Ubah' : 'Tambah' }} Data</p>
        <form action="{{ isset($anak) ? route('anak.update', $anak->id) : route('anak.store') }}" method="POST" class="m-1 p-4">
            @csrf
            @if(isset($anak))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label for="nik" class="block text-gray-800 font-semibold mb-2">NIK</label>
                <input type="text" id="nik" name="nik" value="{{ old('nik', isset($anak) ? $anak->nik : '') }}" placeholder="Masukkan NIK" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
            </div>
            <div class="mb-4">
                <label for="nama" class="block text-gray-800 font-semibold mb-2">Nama Lengkap Anak</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', isset($anak) ? $anak->nama : '') }}" placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">

            </div>
            <div class="mb-4">
                <label for="ibu_id" class="block text-gray-800 font-semibold mb-2">Nama Ibu</label>
                <select name="ibu_id" id="ibu_id" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
                    <option value="">Pilih Nama Ibu</option>
                    @foreach ($ibu as $ibu)
                        <option value="{{ $ibu->id }}" {{ isset($anak) && $anak->ibu_id == $ibu->id ? 'selected' : '' }}>
                            {{ $ibu->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="nm_ayah" class="block text-gray-700 font-semibold mb-2">Nama Ayah</label>
                <input type="text" id="nm_ayah" name="nm_ayah" value="{{ old('nm_ayah', isset($anak) ? $anak->nm_ayah : '') }}" placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
            </div>
            <div class="flex flex-row mb-5">
                <div class="flex-initial w-1/3 mr-5">
                    <label for="tgl_lahir" class="block text-gray-800 font-semibold mb-2">Tanggal Lahir</label>
                    <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', isset($anak) ? $anak->tgl_lahir : '') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500 text-gray-700">
                </div>
                <div class="flex-none w-1/5 mr-5">
                    <label for="anak_ke" class="block text-gray-800 font-semibold mb-2">Anak Ke-</label>
                    <input type="number" id="anak_ke" name="anak_ke" value="{{ old('anak_ke', isset($anak) ? $anak->anak_ke : '') }}" placeholder="0" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500 text-gray-700">
                </div>
            </div>
            <div class="mb-4">
                <label for="jk" class="block text-gray-800 font-semibold mb-2">Jenis Kelamin</label>
                <select id="jk" name="jk" class="w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
                    <option value="" disabled {{ old('jk', isset($anak)) ? '' : 'selected' }}>Pilih Jenis Kelamin</option>
                    <option value="Laki-Laki" {{ old('jk', isset($anak) && $anak->jk) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('jk', isset($anak) && $anak->jk) === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="flex flex-row mb-4">
                <div class="flex-initial w-1/2 mr-5">
                    <label for="bb_lahir" class="block text-gray-800 font-semibold mb-2">Berat Badan Lahir</label>
                    <input type="number" id="bb_lahir" name="bb_lahir" value="{{ old('bb_lahir', isset($anak) ? $anak->bb_lahir : '') }}" placeholder="000.0" class="w-1/2 px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
                     kg
                </div>
                <div class="flex-initial w-1/2 mr-5">
                    <label for="tb_lahir" class="block text-gray-800 font-semibold mb-2">Tinggi Badan Lahir</label>
                    <input type="text" id="tb_lahir" name="tb_lahir" value="{{ old('tb_lahir', isset($anak) ? $anak->tb_lahir : '') }}" placeholder="000.0" class="w-1/2 px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
                     cm
                </div>
            </div>
            <div class="mb-4">
                <label for="jns_persalinan" class="block text-gray-800 font-semibold mb-2">Jenis Persalinan</label>
                <select id="jns_persalinan" name="jns_persalinan" class="w-1/2 px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
                    <option value="" disabled {{ old('jns_persalinan', isset($anak)) ? '' : 'selected' }}>Pilih Jenis Persalinan</option>
                    <option value="Spontan" {{ old('jns_persalinan', isset($anak) && $anak->jns_persalinan) == 'Spontan' ? 'selected' : '' }}>Spontan</option>
                    <option value="Sesar" {{ old('jns_persalinan', isset($anak) && $anak->jns_persalinan) === 'Sesar' ? 'selected' : '' }}>Sesar</option>
                </select>
            </div>

            <div class="flex justify-end mt-6 mr-4">
                <button type="submit" class="px-10 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Submit</button>
            </div>
        </form>
    </section>
</x-layout>

    