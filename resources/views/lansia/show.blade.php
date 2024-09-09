<x-layout>
    <x-slot:title>Detail Data</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <h1 class="font-semibold text-lg uppercase text-purple-800">Data Lansia</h1>

        <!-- alert berhasil -->
        @if (session('success'))   
        <div class="mt-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded absolute" id="success-alert">
            <strong class="font-bold">{{ session('success') }}</strong>
        </div>   
        @endif

        @if($lansia)
        <table class="m-5 table-auto text-left">
            <tbody>
                <tr>
                    <th class="w-1/2 py-1">NIK</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ $lansia->nik }}</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Nama</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ $lansia->nama }}</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Alamat</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ $lansia->alamat }} RT {{ $lansia->rt }} RW {{ $lansia->rw }}</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Tanggal Lahir</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ \Carbon\Carbon::parse($lansia->tgl_lahir)->format('d F o') }}</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Usia</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ \Carbon\Carbon::parse($lansia->tgl_lahir)->age }} Tahun</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Nomor Telephone</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ $lansia->no_telp }}</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Kepemilikan BPJS</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ $lansia->bpjs }}</td>
                </tr>
            </tbody>
        </table>
        @else
            <p>Data Lansia tidak ditemukan.</p>
        @endif 

        <!-- button aksi -->
        <div class="flex justify-end w-1/2">
            <a href="{{ route('lansia.edit', $lansia->id) }}" class="m-2 px-8 py-2 text-white font-semibold rounded-md bg-purple-500 hover:bg-purple-600">Ubah</a>
            <form action="{{ route('lansia.destroy', $lansia->id)}}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="m-2 px-8 py-2 text-white font-semibold rounded-md bg-red-500 hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
            </form>
        </div>
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