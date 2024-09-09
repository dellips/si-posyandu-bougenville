<x-layout>
    <x-slot:title>Detail Data</x-slot:title>

    <section class="m-1 p-8 rounded-md bg-white">
        <h1 class="font-semibold text-lg uppercase text-purple-800">Data Anak</h1>

        <!-- alert berhasil -->
        @if (session('success'))   
        <div class="mt-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded" id="success-alert">
            <strong class="font-bold">{{ session('success') }}</strong>
        </div>   
        @endif

        <table class="m-5 table-auto text-left">
            <tbody>
                <tr>
                    <th class="w-1/2 py-1">NIK</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ $anak->nik }}</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Nama</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ $anak->nama }}</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Berat Badan Lahir</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ $anak->bb_lahir }} kg</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Tinggi Badan Lahir</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ $anak->tb_lahir}} cm</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Tanggal Lahir</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ \Carbon\Carbon::parse($anak->tgl_lahir)->format('d F o')}}</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Usia</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ number_format(\Carbon\Carbon::parse($anak->tgl_lahir)->diffInMonths(\Carbon\Carbon::now())) }} Bulan</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Anak ke-</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ $anak->anak_ke }}</td>
                </tr>
                <tr>
                    <th class="w-1/2 py-1">Persalinan</th>
                    <td class="px-2 py-1">:</td>
                    <td class="px-4 py-1">{{ $anak->jns_persalinan }}</td>
                </tr>
            </tbody>
        </table>

        <!-- button aksi -->
        <div class="flex justify-end w-1/2">
            <a href="{{ route('anak.edit', $anak->id) }}" class="m-2 px-8 py-2 text-white font-semibold rounded-md bg-purple-500 hover:bg-purple-600">Ubah</a>
            <form action="{{ route('anak.destroy', $anak->id)}}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="m-2 px-8 py-2 text-white font-semibold rounded-md bg-red-500 hover:bg-red-600" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
            </form>
        </div>
    </section>

    <section class="m-1 p-8 mt-6 rounded-md bg-white">
        <h1 class="font-semibold text-lg uppercase text-purple-800">Data Ibu</h1>
        @if($anak->ibu)
            <div class="m-1 p-2 rounded-md">
                <ul>
                    <li>
                        <div class="m-1 p-2 mt-2 border-x-2 rounded-md hover:shadow-md hover:font-semibold">
                            <a href="{{ route('ibu.show', $anak->ibu->id) }}">
                                {{ $anak->ibu->nama }}  
                            </a>
                            <p class="ml-4 text-sm font-light">{{ $anak->ibu->nik }}</p>
                            <p class="ml-4 text-sm font-light">{{ \Carbon\Carbon::parse($anak->ibu->tgl_lahir)->format('d F o') }}</p>
                        </div>
                    </li>
                </ul>
            </div>
        @else
            <p class="m-1 p-2 mt-2">Data ibu tidak tersedia.</p>
        @endif
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