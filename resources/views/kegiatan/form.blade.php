<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <p class="font-semibold text-lg uppercase text-green-600">Form Tambah Kegiatan</p>
        <form action="{{ route('kegiatan.store') }}" method="POST" class="m-1 p-4">
            <div class="mb-4">
                <label for="nm_kegiatan" class="block text-gray-700 font-semibold mb-2">Nama Kegiatan</label>
                <input type="text" id="nm_kegiatan" name="nm_kegiatan" placeholder="Masukkan Nama Kegiatan" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500">
            </div>
            <div class="mb-4">
                <label for="tgl_kegiatan" class="block text-gray-700 font-semibold mb-2">Tanggal Kegiatan</label>
                <input type="date" id="tgl_kegiatan" name="tgl_kegiatan" class="w-1/4 px-4 py-2 border rounded-md focus:outline-none focus:border-green-500 text-gray-400">
            </div>
            <div class="mb-4">
                <label for="ket" class="block text-gray-700 font-semibold mb-2">Keterangan</label>
                <input type="text" id="ket" name="ket" class="w-1/4 px-4 py-2 border rounded-md focus:outline-none focus:border-green-500 text-gray-400">
            </div>
            <div class="flex justify-end mt-6 mr-4">
                <button type="submit" class="px-10 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Submit</button>
            </div>
        </form>
    </section>
  </x-layout>