<x-layout>
    <x-slot:title>Pemeriksaan PTM</x-slot:title>
    <section class="m-1 p-8 mb-8 rounded-md bg-white">
        <h3 class="m-1 p-2 font-bold text-xl text-violet-600 uppercase">Data Pemeriksaan PTM</h3>

    <!-- Modal untuk pesan sukses -->
    <dialog id="success_modal" class="modal">
      <div class="modal-box bg-white text-stone-800">
        <h3 class="text-lg font-bold text-success">Sukses!</h3>
        <p class="py-4">{{ session('success') }}</p>
        <div class="modal-action">
          <form action="\pemeriksaan">
            <button class="btn btn-success">Close</button>
          </form>
        </div>
      </div>
    </dialog>

    <div class="flex items-center justify-between my-4 px-8">
        <form id="filter-form" method="GET" action="{{ route('pemeriksaan.filter') }}" class="flex items-center justify-between my-4 px-8">
            <!-- Filter -->
            <div class="flex items-center space-x-4">
                <!-- Filter Nama -->
                <div class="flex-1">
                    <h3 class="font-semibold text-md text-stone-600">Nama</h3>
                    <input type="text" name="nama" id="filter-nama" class="input input-bordered w-full bg-transparent text-stone-800" placeholder="Cari Nama">
                </div>
            
                <!-- Filter Kategori -->
                <div class="flex-1">
                    <h3 class="font-semibold text-md text-stone-600">Kategori</h3>
                    <select name="kategori" id="filter-kategori" class="select select-bordered w-full bg-transparent text-stone-800">
                        <option value="">Semua Kategori</option>
                        <option value="Ibu Hamil" {{ request('kategori') == 'Ibu Hamil' ? 'selected' : '' }}>Ibu Hamil</option>
                        <option value="Ibu" {{ request('kategori') == 'Ibu' ? 'selected' : '' }}>Ibu</option>
                        <option value="Anak" {{ request('kategori') == 'Anak' ? 'selected' : '' }}>Bayi dan Balita</option>
                        <option value="Lansia" {{ request('kategori') == 'Lansia' ? 'selected' : '' }}>Lansia</option>
                    </select>
                </div>
            
                <!-- Filter Kegiatan -->
                <div class="flex-1">
                    <h3 class="font-semibold text-md text-stone-600">Kegiatan</h3>
                    <select name="kegiatan" id="filter-kegiatan" class="select select-bordered bg-transparent text-stone-800">
                        <option value="">Semua Kegiatan</option>
                        <!-- Tambahkan kegiatan yang ada -->
                        @foreach($kegiatans as $kegiatan)
                            <option value="{{ $kegiatan->id }}" {{ request('kegiatan') == $kegiatan->id ? 'selected' : '' }}>
                                {{ $kegiatan->nm_kegiatan }}
                            </option>                        
                        @endforeach
                    </select>
                </div>
                
                <!-- Tombol Filter -->
                <button type="submit" class="btn btn-primary mt-4">Terapkan Filter</button>
            </div>
        </form>        
    </div>

    <!-- Tambah Data -->
    <div class="flex justify-end items-center">
        <a href="/pemeriksaan/create" class="btn btn-primary text-white flex items-center space-x-2">
          <svg class="h-4 w-4 text-white"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
            <path stroke="none" d="M0 0h24v24H0z"/>  
            <line x1="12" y1="5" x2="12" y2="19" />  
            <line x1="5" y1="12" x2="19" y2="12" /></svg>
          <span>Tambah Pemeriksaan</span>
        </a>    
    </div>

        <!-- table -->
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
                <th>Berat Badan</th>
                <th>Tinggi Badan</th>
                <th>Perubahan Berat</th>
                <th>Aksi</th>
            </thead>
            <tbody class="text-stone-600 text-center">
                @if (!$pemeriksaans->isEmpty())
                    @foreach ($pemeriksaans as $pemeriksaan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pemeriksaan->kegiatan->nm_kegiatan }}</td>
                        <td>
                            {{ $pemeriksaan->sasaran ? $pemeriksaan->sasaran->nama : ($pemeriksaan->anak ? $pemeriksaan->anak->nama : '-') }}
                        </td>
                        <td>
                            {{ $pemeriksaan->sasaran ? \Carbon\Carbon::parse($pemeriksaan->sasaran->tgl_lahir)->age . ' Tahun' : ($pemeriksaan->anak ? number_format(\Carbon\Carbon::parse($pemeriksaan->anak->tgl_lahir)->diffInMonths(\Carbon\Carbon::now())) . ' Bulan' : '-') }}
                        </td>                                              
                        <td>{{ $pemeriksaan->bb }}</td>
                        <td>{{ $pemeriksaan->tb }}</td>
                        <td>
                            @php
                                // Akses langsung accessor
                                $perubahanBerat = $pemeriksaan->perubahan_berat; 
                            @endphp
                            @if($perubahanBerat)
                                {{ ucfirst($perubahanBerat['status']) }}
                            @else
                                Tidak Ada Data
                            @endif
                        </td>
                        <td>
                          <div class="join">
                            <a href="{{ route('pemeriksaan.show', $pemeriksaan->id) }}" class="btn btn-info join-item">
                              <svg 
                                class="h-4 w-4 text-stone-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />  
                                <polyline points="14 2 14 8 20 8" />  
                                <line x1="16" y1="13" x2="8" y2="13" />  
                                <line x1="16" y1="17" x2="8" y2="17" />  
                                <polyline points="10 9 9 9 8 9" /></svg>
                              </a>
                              <a href="{{ route('pemeriksaan.edit', $pemeriksaan->id) }}" class="btn btn-info join-item">
                                <svg 
                                  class="h-4 w-4 text-stone-900"  width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                  <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />  
                                  <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
                                </a>
                                <form action="{{ route('pemeriksaan.destroy', $pemeriksaan->id)}}" method="POST" style="display:inline;">
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
    @if (session('success'))
        window.onload = function() {
            document.getElementById('success_modal').showModal();
        }
    @endif

    document.getElementById('filter-kegiatan').addEventListener('change', function() {
    const kegiatanId = this.value;

    const url = new URL('/pemeriksaan/filter', window.location.origin);
    url.searchParams.set('kegiatan', kegiatanId);

    fetch(url)
        .then(response => response.json()) // Pastikan server merespons dengan JSON
        .then(data => {
            updateTable(data); // Perbarui tabel dengan data baru
        })
        .catch(error => console.error('Error:', error));
});

    document.getElementById('filter-kategori').addEventListener('change', function() {
    const kategori = this.value;

    const url = new URL('/pemeriksaan/filter', window.location.origin);
    url.searchParams.set('kategori', kategori);

    fetch(url)
        .then(response => response.json())
        .then(data => {
            updateTable(data); // Perbarui tabel dengan data baru
        })
        .catch(error => console.error('Error:', error));
});


document.querySelectorAll('.sort-btn').forEach(button => {
    button.addEventListener('click', function() {
        const order = this.getAttribute('data-order');
        const direction = this.getAttribute('data-direction');

        fetch(`/pemeriksaan/filter?order=${order}&direction=${direction}`)
            .then(response => response.json())
            .then(data => {
                updateTable(data);
            })
            .catch(error => console.error('Error:', error));
    });
});

function updateTable(data) {
    const tableBody = document.querySelector('tbody');
    tableBody.innerHTML = ''; // Kosongkan tabel

    if (data.length > 0) {
        data.forEach(pemeriksaan => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${pemeriksaan.id}</td>
                <td>${pemeriksaan.kegiatan ? pemeriksaan.kegiatan.nm_kegiatan : '-'}</td>
                <td>${pemeriksaan.sasaran ? pemeriksaan.sasaran.nama : (pemeriksaan.anak ? pemeriksaan.anak.nama : '-')}</td>
                <td>${pemeriksaan.sasaran ? moment(pemeriksaan.sasaran.tgl_lahir).fromNow() : (pemeriksaan.anak ? moment(pemeriksaan.anak.tgl_lahir).fromNow() : '-')}</td>
                <td>${pemeriksaan.bb}</td>
                <td>${pemeriksaan.tb}</td>
                <td>${pemeriksaan.perubahan_berat ? pemeriksaan.perubahan_berat.status : 'Tidak Ada Data'}</td>
                <td>
                  <div class="join">
                    <a href="/pemeriksaan/${pemeriksaan.id}" class="btn btn-info join-item">Show</a>
                    <a href="/pemeriksaan/${pemeriksaan.id}/edit" class="btn btn-info join-item">Edit</a>
                    <form action="/pemeriksaan/${pemeriksaan.id}" method="POST" style="display:inline;">
                      <input type="hidden" name="_method" value="DELETE">
                      <button type="submit" class="btn btn-error join-item" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                    </form>
                  </div>
                </td>
            `;
            tableBody.appendChild(row);
        });
    } else {
        tableBody.innerHTML = '<tr><td colspan="8" class="text-center py-2">Tidak ada data.</td></tr>';
    }
}

</script>




