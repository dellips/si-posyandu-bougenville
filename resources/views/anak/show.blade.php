<x-layout>
    <x-slot:title>Detail Data</x-slot:title>

<p>Nama: {{ $anak->nama }}</p> 
<p>Alamat: {{ $anak->alamat }}</p>
<p>Tanggal Lahir: {{ $anak->tgl_lahir }}</p>
<p>Usia: {{ $usia }} tahun</p>
</x-layout>