<x-layout>
  <x-slot:title>Data Ibu Hamil</x-slot:title>
  <section class="m-1 p-8 rounded-md bg-white">
    <h3 class="m-1 p-2 font-bold text-xl text-violet-600 uppercase">Data Ibu Hamil</h3>
    <div class="flex justify-between items-center my-4 mx-8">
      <!-- Tambah Data -->
      <div class="flex items-center">
        <a href="/user/create" class="btn btn-primary text-white flex items-center space-x-2">
          <svg class="h-4 w-4 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
            <path stroke="none" d="M0 0h24v24H0z"/>  
            <line x1="12" y1="5" x2="12" y2="19" />  
            <line x1="5" y1="12" x2="19" y2="12" /></svg>
          <span>Tambah Akun</span>
        </a>    
      </div>

      <!--Cetak Data-->
      <div class="relative">
        <a href="{{ route('laporan.ibuHamil.pdf') }}" class="btn btn-primary text-white flex items-center space-x-2">
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

    <!-- Modal untuk pesan sukses -->
    <dialog id="success_modal" class="modal">
      <div class="modal-box bg-white text-stone-800">
        <h3 class="text-lg font-bold text-success">Sukses!</h3>
        <p class="py-4">{{ session('success') }}</p>
        <div class="modal-action">
          <form action="\user">
            <button class="btn btn-success">Close</button>
          </form>
        </div>
      </div>
    </dialog>
    
    <!-- table -->
    <div class="overflow-x-auto">
      <table class="table table-md m-2">
        <thead class=" text-stone-700 font-semibold text-base text-center">
          <th></th>
          <th>
            <div class="flex justify-between items-center">
                <span class="mx-auto">Nama</span>
                <div class="flex space-x-1">
                    <button class="sort-btn text-sm" data-order="nama" data-direction="asc">↑</button>
                    <button class="sort-btn text-sm" data-order="nama" data-direction="desc">↓</button>
                </div>
            </div>
          </th>
          <th>
            <div class="flex justify-between items-center">
              <span class="mx-auto">Usia</span>
              <div class="flex space-x-1">
                <button class="sort-btn text-sm" data-order="tgl_lahir" data-direction="asc">↑</button>
                <button class="sort-btn text-sm" data-order="tgl_lahir" data-direction="desc">↓</button>
              </div>
            </div>
          </th>
          <th>
            <div class="flex justify-between items-center">
              <span class="mx-auto">Posisi</span>
              <div class="flex space-x-1">
                <button class="sort-btn text-sm" data-order="posisi" data-direction="asc">↑</button>
                <button class="sort-btn text-sm" data-order="posisi" data-direction="desc">↓</button>
              </div>
            </div>
          </th>
          <th>Aksi</th>
        </thead>
        <tbody class="text-stone-600 text-center">
          @if (!$users->isEmpty())
          @foreach ($users as $user)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->nama }}</td>
            <td>{{ \Carbon\Carbon::parse($user->tgl_lahir)->age }} Tahun</td>
            <td>{{ $user->posisi }}</td>
            <td>
              <div class="join">
                <a href="{{ route('user.show', $user->id) }}" class="btn btn-info join-item">
                  <svg 
                    class="h-4 w-4 text-stone-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />  
                    <polyline points="14 2 14 8 20 8" />  
                    <line x1="16" y1="13" x2="8" y2="13" />  
                    <line x1="16" y1="17" x2="8" y2="17" />  
                    <polyline points="10 9 9 9 8 9" /></svg>
                  </a>
                  <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info join-item">
                    <svg 
                      class="h-4 w-4 text-stone-900"  width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />  
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
                    </a>
                    <form action="{{ route('user.destroy', $user->id)}}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-error join-item" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                        <svg 
                          class="h-4 w-4 text-stone-800"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="3 6 5 6 21 6" />  
                          <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />  
                          <line x1="10" y1="11" x2="10" y2="17" />  
                          <line x1="14" y1="11" x2="14" y2="17" /></svg>
                      </button>
                    </form>
              </div>
            </td>
          </tr>
          @endforeach
          @else
          <tr>
            <td colspan="4" class="text-center py-2">Tidak ada data.</td>
          </tr>
          @endif
        </tbody>
      </table>
    </div>
    <table class="m-2 table-auto min-w-full border-collapse border border-slate-400 rounded-lg overflow-hidden shadow-lg items-center text-center">
      <thead class="py-2 bg-blue-100">
        <th class="border w-20 py-2 border-slate-300">
          <a href="{{ route('ibu.index', ['sort' => 'id', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
            No
          </a>
        </th>
        <th class="border border-slate-300">
          <a href="{{ route('ibu.index', ['sort' => 'nik', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
            NIK
          </a>
        </th>
        <th class="border border-slate-300">
          <a href="{{ route('ibu.index', ['sort' => 'nama', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
            Nama
          </a>
        </th>
        <th class="border border-slate-300">
          <a href="{{ route('ibu.index', ['sort' => 'tgl_lahir', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
            Usia
          </a>
        </th>
        <th class="border border-slate-300">
          <a href="{{ route('ibu.index', ['sort' => 'status', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
            Status
          </a>
        </th>
        <th class="border border-slate-300">
          <a href="{{ route('user.index', ['sort' => 'alamat', 'direction' => $sortDirection === 'asc' ? 'desc' : 'asc']) }}">
            Alamat
          </a>
        </th>
        <th class="border border-slate-300">Aksi</th>
      </thead>
      <tbody id="tBody-ibu">
        @foreach ($ibus as $ibu)
        <tr>
          <td class="border px-4 py-2 border-slate-300">{{ $loop->iteration }}</td>
          <td class="border px-4 py-2 border-slate-300">{{ $ibu->nik}}</td>
          <td class="border px-4 py-2 border-slate-300">{{ $ibu->nama}}</td>
          <td class="border px-4 py-2 border-slate-300">{{ \Carbon\Carbon::parse($ibu->tgl_lahir)->age }} tahun</td>
          <td class="border px-4 py-2 border-slate-300">{{ $ibu->status_hamil }}</td>
          <td class="border px-4 py-2 border-slate-300">{{ $ibu->alamat }}</td>
          <td class="border px-4 py-2 border-slate-300">
            <a href="{{ route('ibu.show', $ibu->id) }}" class="btn btn-info rounded-md px-3 py-1 border border-gray-100 hover:text-purple-500 hover:border-purple-500">Lihat</a>
            <a href="{{ route('ibu.edit', $ibu->id) }}" class="btn btn-info rounded-md px-3 py-1 border border-gray-100 hover:text-purple-500 hover:border-purple-500">Ubah</a>
            <form action="{{ route('ibu.destroy', $ibu->id)}}" method="POST" style="display:inline;">
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