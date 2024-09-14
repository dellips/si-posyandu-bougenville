<x-layout>
    <x-slot:title>Kegiatan Posyandu</x-slot:title>
    <!-- form kegiatan -->
    <section class="m-1 p-8 mb-8 rounded-md bg-white">
      <h3 class="m-1 p-2 font-bold text-xl text-violet-600 uppercase">Tambah Kegiatan</h3>
      
      <!-- alert error -->
      @if ($errors->any())
      <div class="mt-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded" role="alert">
          <strong class="font-bold">Terdapat kesalahan!</strong>
          <ul class="mt-3 list-disc list-inside text-sm text-red-600">
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <!-- form -->
      <form action="{{ isset($kegiatan) ? route('kegiatan.update', $kegiatan->id) : route('kegiatan.store') }}" method="POST" class="m-1 p-4 text-stone-800">
          @csrf
          @if (isset($kegiatan))
              @method('PUT')
          @endif
          <div class="mb-4">
              <label for="nm_kegiatan" class="block text-gray-800 font-semibold mb-2">Nama Kegiatan</label>
              <input type="text" id="nm_kegiatan" name="nm_kegiatan" value="{{ old('nm_kegiatan', isset($kegiatan) ? $kegiatan->nm_kegiatan : '') }}" placeholder="Masukkan Nama Kegiatan" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
          </div>
          <div class="mb-4">
              <label for="tgl_kegiatan" class="block text-gray-800 font-semibold mb-2">Tanggal Kegiatan</label>
              <input type="date" id="tgl_kegiatan" name="tgl_kegiatan" value="{{ old('tgl_kegiatan', isset($kegiatan) ? $kegiatan->tgl_kegiatan : '') }}" class="w-1/4 px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 text-gray-700 bg-white">
          </div>
          <div class="mb-4">
              <label for="ket" class="block text-gray-800 font-semibold mb-2">Keterangan</label>
              <input type="text" id="ket" name="ket" value="{{ old('ket', isset($kegiatan) ? $kegiatan->ket : '') }}" placeholder="Masukan Keterangan" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 bg-white">
          </div>
          <div class="flex justify-end mt-6 mr-4">
              <button type="submit" class="btn btn-primary px-5 py-1 text-white flex items-center">
                <svg class="h-4 w-4 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                  <path stroke="none" d="M0 0h24v24H0z"/>  
                  <path d="M5 12l5 5l10 -10" /></svg>
                <span>Simpan</span>
              </button>
          </div>
      </form>
    </section>

    <!-- Modal untuk pesan sukses -->
    <dialog id="success_modal" class="modal">
      <div class="modal-box bg-white text-stone-800">
        <h3 class="text-lg font-bold text-success">Sukses!</h3>
        <p class="py-4">{{ session('success') }}</p>
        <div class="modal-action">
          <form action="\kegiatan">
            <button class="btn btn-success">Close</button>
          </form>
        </div>
      </div>
    </dialog>

    <!-- table kegiatan -->
    <section class="m-1 p-8 rounded-md bg-white">
      <h3 class="m-1 p-2 font-bold text-xl text-violet-600 uppercase">Data Kegiatan</h3>
      <div class="flex items-center my-4 px-8">
        <h3 class="font-semibold text-md text-stone-600 pr-5">Kegiatan</h3>
        <select id="filter" class="select select-bordered select-primary w-full max-w-xs bg-transparent text-stone-800">
          <option value="">Keseluruhan</option>
          <option value="month">Bulan ini</option>
          <option value="year">Tahun ini</option>
      </select>
      </div>
      <div class="overflow-x-auto">
        <table class="table table-md m-2">
          <thead class=" text-stone-700 font-semibold text-base text-center">
            <th></th>
            <th>
              <div class="flex justify-between items-center">
                  <span class="mx-auto">Kegiatan</span>
                  <div class="flex space-x-1">
                    <button class="sort-btn text-sm" data-order="nm_kegiatan" data-direction="asc">↑</button>
                    <button class="sort-btn text-sm" data-order="nm_kegiatan" data-direction="desc">↓</button>
                </div>
              </div>
            </th>
            <th>
              <div class="flex justify-between items-center">
                <span class="mx-auto">Tanggal Kegiatan</span>
                <div class="flex space-x-1">
                  <button class="sort-btn text-sm" data-order="tgl_kegiatan" data-direction="asc">↑</button>
                  <button class="sort-btn text-sm" data-order="tgl_kegiatan" data-direction="desc">↓</button>
              </div>
              </div>
            </th>
            <th>
              <div class="flex justify-between items-center">
                <span class="mx-auto">Keterangan</span>
              </div>
            </th>
            <th>Aksi</th>
          </thead>
          <tbody class="text-stone-600 text-center">
            @if (!$kegiatans->isEmpty())
            @foreach ($kegiatans as $kegiatan)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $kegiatan->nm_kegiatan }}</td>
              <td>{{ $kegiatan->tgl_kegiatan }} </td>
              <td>{{ $kegiatan->ket }}</td>
              <td>
                <div class="join">
                  <a href="{{ route('kegiatan.show', $kegiatan->id) }}" class="btn btn-info join-item">
                    <svg 
                      class="h-4 w-4 text-stone-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                      <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />  
                      <polyline points="14 2 14 8 20 8" />  
                      <line x1="16" y1="13" x2="8" y2="13" />  
                      <line x1="16" y1="17" x2="8" y2="17" />  
                      <polyline points="10 9 9 9 8 9" /></svg>
                    </a>
                    <a href="{{ route('kegiatan.edit', $kegiatan->id) }}" class="btn btn-info join-item">
                      <svg 
                        class="h-4 w-4 text-stone-900"  width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />  
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
                      </a>
                      <form action="{{ route('kegiatan.destroy', $kegiatan->id)}}" method="POST" style="display:inline;">
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
    </section>
</x-layout>

<script>
  // Jika ada pesan 'success' di session, tampilkan modal
  @if (session('success'))
        window.onload = function() {
            document.getElementById('success_modal').showModal();
        }
  @endif

  document.getElementById('filter').addEventListener('change', function() {
    let filterValue = this.value;
    fetchKegiatanData(filterValue);
});

function fetchKegiatanData(filterValue) {
    fetch(`/kegiatans/filter?filter=${filterValue}`)
    .then(response => response.json())
    .then(data => {
        updateTable(data);
    });
}

function updateTable(kegiatans) {
    const tbody = document.querySelector('tbody');
    tbody.innerHTML = ''; // Bersihkan isi tabel

    if (kegiatans.length === 0) {
        tbody.innerHTML = '<tr><td colspan="4" class="text-center py-2">Tidak ada data.</td></tr>';
    } else {
        kegiatans.forEach((kegiatan, index) => {
            tbody.innerHTML += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${kegiatan.nm_kegiatan}</td>
                    <td>${kegiatan.tgl_kegiatan}</td>
                    <td>${kegiatan.ket}</td>
                    
                </tr>`;
        });
    }
}

document.querySelectorAll('.sort-btn').forEach(button => {
    button.addEventListener('click', function() {
        const order = this.getAttribute('data-order');
        const direction = this.getAttribute('data-direction');

        const url = new URL(window.location.href);
        url.searchParams.set('order', order);
        url.searchParams.set('direction', direction);

        window.location.href = url.toString();  // Redirect dengan parameter sorting dan tab aktif
    });
});


</script>
