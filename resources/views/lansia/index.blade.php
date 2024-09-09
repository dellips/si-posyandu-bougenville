<x-layout>
    <x-slot:title>Data Lansia</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
      <p class="font-semibold text-lg uppercase text-purple-800">Data Lansia</p>
      <!-- tambah dan cetak data -->
      <div class="flex justify-between items-center my-4 mx-8">
        <a href="/create" class="m-2 px-8 py-2 font-semibold text-white rounded-md bg-purple-500 hover:bg-purple-600">
          Tambah Data
        </a>
          
        <div class="relative">
          <a href="{{ route('laporan.lansia.pdf') }}" class="m-2 px-8 py-2 font-semibold text-white rounded-md bg-purple-500 hover:bg-purple-600 flex items-center">
            <svg class="h-5 w-5 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" />
              <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
              <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
              <rect x="7" y="13" width="10" height="8" rx="2" />
            </svg>
            Cetak Data
          </a>
        </div> 
      </div>

       <!-- alert berhasil -->
       @if (session('success'))
       <div class="mt-4 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded" id="success-alert">
           <strong class="font-bold">{{ session('success') }}</strong>
       </div>
       @endif

      <table class="m-2 table-auto min-w-full border-collapse border border-slate-400 rounded-lg overflow-hidden shadow-lg items-center text-center">
        <thead class="py-2 bg-blue-100">
          <th class="border w-20 py-2 border-slate-300">
            <a href="{{ route('lansia.index', ['sort' => 'id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
              No
            </a>
          </th>
          <th class="border border-slate-300">
            <a href="{{ route('lansia.index', ['sort' => 'nik', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
              NIK
            </a>
          </th>
          <th class="border border-slate-300">
            <a href="{{ route('lansia.index', ['sort' => 'nama', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
              Nama
            </a>
          </th>
          <th class="border border-slate-300">
            <a href="{{ route('lansia.index', ['sort' => 'tgl_lahir', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
              Usia
            </a>
          </th>
          <th class="border border-slate-300">
            <a href="{{ route('lansia.index', ['sort' => 'alamat', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
              Alamat
            </a>
          </th>
          <th class="border border-slate-300">Aksi</th>
        </thead>
        <tbody id="tableBody-kegiatan">
            @foreach ($lansias as $lansia)
            <tr>
                <td class="border px-4 py-2 border-slate-300">{{ $loop->iteration }}</td>
                <td class="border px-4 py-2 border-slate-300">{{ $lansia->nik }}</td>
                <td class="border px-4 py-2 border-slate-300">{{ $lansia->nama }}</td>
                <td class="border px-4 py-2 border-slate-300">{{ \Carbon\Carbon::parse($lansia->tgl_lahir)->age }} Tahun</td>
                <td class="border px-4 py-2 border-slate-300">{{ $lansia->alamat }}</td>
                <td class="border px-4 py-2 border-slate-300">
                  <a href="{{ route('lansia.show', $lansia->id) }}" class="btn btn-info rounded-md px-3 py-1 border border-gray-100 hover:text-purple-500 hover:border-purple-500">Lihat</a>
                  <a href="{{ route('lansia.edit', $lansia->id) }}" class="btn btn-info rounded-md px-3 py-1 border border-gray-100 hover:text-purple-500 hover:border-purple-500">Ubah</a>
                  <form action="{{ route('lansia.destroy', $lansia->id)}}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-md px-3 py-1 border border-gray-100 hover:text-red-500 hover:border-red-500" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                  </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
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