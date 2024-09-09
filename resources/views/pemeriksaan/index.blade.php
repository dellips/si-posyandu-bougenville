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
              <form action="\user">
                <button class="btn btn-success">Close</button>
              </form>
            </div>
          </div>
        </dialog>

        <div class="flex items-center justify-between my-4 px-8">
            <!-- Filter -->
            <div class="flex items-center space-x-4">
                <!-- Filter Nama -->
                <div class="flex-1">
                    <h3 class="font-semibold text-md text-stone-600">Nama</h3>
                    <input type="text" id="filter-nama" class="input input-bordered w-full bg-transparent text-stone-800" placeholder="Cari Nama">
                </div>
            
                <!-- Filter Kategori -->
                <div class="flex-1">
                    <h3 class="font-semibold text-md text-stone-600">Kategori</h3>
                    <select id="filter-kategori" class="select select-bordered w-full bg-transparent text-stone-800">
                        <option value="">Semua Kategori</option>
                        <option value="Ibu Hamil">Ibu Hamil</option>
                        <option value="Ibu">Ibu</option>
                        <option value="Anak">Bayi dan Balita</option>
                        <option value="Lansia">Lansia</option>
                    </select>
                </div>
            
                <!-- Filter Kegiatan -->
                <div class="flex-1">
                    <h3 class="font-semibold text-md text-stone-600">Kegiatan</h3>
    <select id="filter-kegiatan" class="select select-bordered bg-transparent text-stone-800">
        <option value="">Semua Kegiatan</option>
        <!-- Tambahkan kegiatan yang ada -->
        @foreach($kegiatans as $kegiatan)
            <option value="{{ $kegiatan->id }}">{{ $kegiatan->nm_kegiatan }}</option>
        @endforeach
    </select>
                </div>

    <!-- Tombol Filter -->
    <button id="filter-btn" class="btn btn-primary mt-4">Terapkan Filter</button>
</div>
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
                <th>IMT</th>
                <th>Aksi</th>
            </thead>
            <tbody class="text-stone-600 text-center">
                @if (!$pemeriksaans->isEmpty())
                    @foreach ($pemeriksaans as $pemeriksaan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $pemeriksaan->sasaran ? $pemeriksaan->sasaran->nama : ($pemeriksaan->anak ? $pemeriksaan->anak->nama : '-') }}
                        </td>
                        <td>
                            {{ $pemeriksaan->sasaran ? \Carbon\Carbon::parse($pemeriksaan->sasaran->tgl_lahir)->age . ' Tahun' : ($pemeriksaan->anak ? number_format(\Carbon\Carbon::parse($pemeriksaan->anak->tgl_lahir)->diffInMonths(\Carbon\Carbon::now())) . ' Bulan' : '-') }}
                        </td>                                              
                        <td>{{ $pemeriksaan->bb }}</td>
                        <td>{{ $pemeriksaan->tb }}</td>
                        <td>{{ $pemeriksaan->imt }}</td>
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

    <script>
        document.getElementById('filter-btn').addEventListener('click', function() {
    let kategori = document.getElementById('filter-kategori').value;
    let nama = document.getElementById('filter-nama').value;
    let kegiatan = document.getElementById('filter-kegiatan').value;

    let url = `/pemeriksaan/filter?kategori=${kategori}&nama=${nama}&kegiatan=${kegiatan}`;

    console.log("Fetching URL: ", url); // Untuk memastikan URL sudah benar
    
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("Fetched Data: ", data); // Debugging response dari server
            updateTable(data);
        })
        .catch(error => console.error('Error:', error));
        });

    
        function updateTable(data) {
            let tableBody = document.querySelector('tbody');
            tableBody.innerHTML = '';
    
            if (data.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7" class="text-center py-2">Tidak ada data.</td>
                    </tr>
                `;
            } else {
                data.forEach((pemeriksaan, index) => {
                    let nama = '-';
                    let umur = '-';
    
                    if (pemeriksaan.sasaran) {
                        nama = pemeriksaan.sasaran.nama;
                        umur = `${new Date().getFullYear() - new Date(pemeriksaan.sasaran.tgl_lahir).getFullYear()} Tahun`;
                    } else if (pemeriksaan.anak) {
                        nama = pemeriksaan.anak.nama;
                        umur = `${Math.floor((new Date() - new Date(pemeriksaan.anak.tgl_lahir)) / (1000 * 60 * 60 * 24 * 30))} Bulan`;
                    }
    
                    let bb = pemeriksaan.bb || '-';
                    let tb = pemeriksaan.tb || '-';
                    let imt = pemeriksaan.imt || '-';
    
                    let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${nama}</td>
                            <td>${umur}</td>
                            <td>${bb}</td>
                            <td>${tb}</td>
                            <td>${imt}</td>
                            <td>
                                <!-- Tombol aksi -->
                            </td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });
            }
        }
    </script>
</x-layout>



