<x-layout>
    <x-slot:title>Detail Data</x-slot:title>

<p>Nama: {{ $ibu->nama }}</p> 
<p>Alamat: {{ $ibu->alamat }}</p>
<p>Tanggal Lahir: {{ $ibu->tgl_lahir }}</p>
<p>Usia: {{ $usia }} tahun</p>
</x-layout>