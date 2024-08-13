<x-layout>
    <x-slot:title>Data Ibu</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <p class="font-semibold text-lg uppercase text-green-600">Form {{ isset($ibu) ? 'Ubah' : 'Tambah' }} Data</p>
        <form action="{{ isset($ibu) ? route('ibu.update', $ibu->id) : route('ibu.store') }}" method="POST" class="m-1 p-4">
            @csrf
            @if(isset($ibu))
                @method('PUT')
            @endif
            <div class="mb-4">
                <label for="nik" class="block text-gray-800 font-semibold mb-2">NIK</label>
                <input type="text" id="nik" name="nik" value="{{ old('nik', isset($ibu) ? $ibu->nik : '') }}" placeholder="Masukkan NIK" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
            </div>
            <div class="mb-4">
                <label for="nama" class="block text-gray-800 font-semibold mb-2">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama', isset($ibu) ? $ibu->nama : '') }}" placeholder="Masukkan Nama Lengkap" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
            </div>
            <div class="mb-4">
                <label for="tgl_lahir" class="block text-gray-800 font-semibold mb-2">Tanggal Lahir</label>
                <input type="date" id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir', isset($ibu) ? $ibu->tgl_lahir : '') }}" class="w-1/4 px-4 py-2 border rounded-md focus:outline-none focus:border-green-500 text-gray-700">
            </div>
            <div class="flex flex-row mb-4">
                <div class="flex-initial w-1/3 mr-5">
                    <label for="alamat" class="block text-gray-800 font-semibold mb-2">Alamat</label>
                    <input type="text" id="alamat" name="alamat" value="{{ old('alamat', isset($ibu) ? $ibu->alamat : '') }}" placeholder="Masukkan Alamat" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
                </div>
                <div class="flex-none w-14 mr-5">
                    <label for="rt" class="block text-gray-800 font-semibold mb-2">RT</label>
                    <input type="text" id="rt" name="rt" value="{{ old('rt', isset($ibu) ? $ibu->rt : '') }}" placeholder="00" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
                </div>
                <div class="flex-none w-14 mr-5">
                    <label for="rw" class="block text-gray-800 font-semibold mb-2">RW</label>
                    <input type="text" id="rw" name="rw" value="{{ old('rw', isset($ibu) ? $ibu->rw : '') }}" placeholder="00" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
                </div>
            </div>
            <div class="mb-4">
                <label for="no_telp" class="block text-gray-800 font-semibold mb-2">Nomor Telepon</label>
                <input type="text" id="no_telp" name="no_telp" value="{{ old('no_telp', isset($ibu) ? $ibu->no_telp : '') }}" placeholder="Masukkan Nomor Telepon" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
            </div>
            <div class="flex flex-row mb-4">
                <div class="flex-initial w-1/3 mr-5 text-gray-700">
                    <label for="is_hamil" class="block text-gray-800 font-semibold mb-2">Status</label>
                    <select id="is_hamil" name="is_hamil" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
                        <option value="" disabled {{ old('is_hamil', isset($ibu)) ? '' : 'selected' }}>Pilih Status</option>
                        <option value="Tidak Hamil" {{ old('is_hamil', isset($ibu) && $ibu->is_hamil) == 'Tidak Hamil' ? 'selected' : '' }}>Tidak Hamil</option>
                        <option value="Hamil" {{ old('is_hamil', isset($ibu) && $ibu->is_hamil) === 'Hamil' ? 'selected' : '' }}>Hamil</option>
                    </select>
                </div>
                <div class="flex-none w-1/3 text-gray-700">
                    <label for="bpjs" class="block text-gray-800 font-semibold mb-2">Kepunyaan BPJS</label>
                    <select id="bpjs" name="bpjs" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
                        <option value="" disabled {{ old('bpjs', isset($ibu)) ? '' : 'selected' }}>Pilih Kepunyaan BPJS</option>
                        <option value="Ada" {{ old('bpjs', isset($ibu) && $ibu->bpjs) === 'Ada' ? 'selected' : '' }}>Ada</option>
                        <option value="Tidak Ada" {{ old('bpjs', isset($ibu) && $ibu->bpjs) === 'Tidak Ada' ? 'selected' : '' }}>Tidak Ada</option>
                    </select>                
                </div>
            </div>
            <div class="flex justify-end mt-6 mr-4">
                <button type="submit" class="px-10 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">{{ isset($ibu) ? 'Update' : 'Submit' }}</button>
            </div>
        </form>
    </section>
</x-layout>