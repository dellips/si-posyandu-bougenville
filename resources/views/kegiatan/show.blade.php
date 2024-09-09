<x-layout>
    <x-slot:title>Detail Kegiatan</x-slot:title>
    <!-- detail -->
    <section class="m-1 p-8 rounded-md bg-white">
        <div class="flex items-center">
            <a href="/kegiatan" class="px-4">
                <svg class="h-6 w-6 text-stone-400 hover:text-stone-800"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                    <path stroke="none" d="M0 0h24v24H0z"/>  
                    <line x1="5" y1="12" x2="19" y2="12" />  
                    <line x1="5" y1="12" x2="9" y2="16" />  
                    <line x1="5" y1="12" x2="9" y2="8" /></svg>
            </a>
            <h1 class="font-semibold text-lg uppercase text-violet-600">Detail Kegiatan</h1>
        </div>

        <!-- Modal untuk pesan sukses -->
    <dialog id="success_modal" class="modal">
        <div class="modal-box bg-white text-stone-800">
            <h3 class="text-lg font-bold text-success">Sukses!</h3>
            <p class="py-4">{{ session('success') }}</p>
            <div class="modal-action">
                <form action="\kegiatan\{{ $kegiatan->id }}">
                    <button class="btn btn-success">Close</button>
                </form>
            </div>
        </div>
    </dialog>

    <!-- garis -->
    <div class="divider"></div>

    <!-- data pengguna -->
    <div class="collapse collapse-arrow bg-transparent text-stone-800">
        <input type="radio" name="my-accordion-1" checked="checked"/>
        <div class="collapse-title text-lg font-semibold text-stone-600">Kegiatan</div>
        <div class="collapse-content">
            <table class="m-1 mx-4 table-auto text-left">
                <tbody>
                    <tr>
                        <th class="w-1/2 py-1">Kegiatan</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{ $kegiatan->nm_kegiatan }}</td>
                    </tr>
                    <tr>
                        <th class="w-1/2 py-1">Tanggal Kegiatan</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{\Carbon\Carbon::parse($kegiatan->tgl_kegiatan)->format('d F o')}}</td>
                    </tr>
                    <tr>
                        <th class="w-1/2 py-1">Keterangan</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{ $kegiatan->ket }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>

        <!-- button aksi -->
      <div class="flex items-center space-x-4 m-1 mx-5">
        <span class="text-lg font-semibold text-stone-600">Aksi</span>
      </div>
      <div class="join justify-center w-1/3">
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
    </section>

    <!-- load data pemeriksaan -->
    <section class="m-1 p-8 rounded-md bg-white my-6">
        <h1 class="font-semibold text-lg uppercase text-violet-600">Pemeriksaan</h1>
        <div class="flex items-center my-4 px-8">
            <h3 class="font-semibold text-md text-stone-600 pr-5">Filter</h3>
            <select id="filter" class="select select-bordered select-primary w-full max-w-xs bg-transparent text-stone-800">
              <option value="">Semua Data</option>
              <option value="ibu">Ibu</option>
              <option value="anak">anak</option>
              <option value="ibu_hamil">Ibu Hamil</option>
              <option value="lansia">lansia</option>
          </select>
          </div>
          <div class="overflow-x-auto">
            <table class="table table-md m-2">
              <thead class=" text-stone-700 font-semibold text-base text-center">
                <th></th>
                <th>
                  <div class="flex justify-between items-center">
                      <span class="mx-auto">Tanggal Pemeriksaan</span>
                  </div>
                </th>
                <th>
                  <div class="flex justify-between items-center">
                    <span class="mx-auto">Nama</span>
                  </div>
                </th>
                <th>
                  <div class="flex justify-between items-center">
                    <span class="mx-auto">Berat Badan</span>
                  </div>
                </th>
                <th>
                    <div class="flex justify-between items-center">
                      <span class="mx-auto">Tinggi Badan</span>
                    </div>
                </th>
                <th>
                    <div class="flex justify-between items-center">
                      <span class="mx-auto">Kategori</span>
                    </div>
                </th>
                <th>Aksi</th>
              </thead>
              <tbody class="text-stone-600 text-center">
                @if ($kegiatan->pemeriksaan->isEmpty())
                <tr>
                    <td colspan="6" class="text-center py-2">Tidak ada data.</td>
                </tr>
                @else
                    @foreach ($kegiatan->pemeriksaan as $pemeriksaan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $kegiatan->tgl_kegiatan }}</td>
                            <td>{{ $pemeriksaan->sasaran ? $pemeriksaan->sasaran->nama : ($pemeriksaan->anak ? $pemeriksaan->anak->nama : '-') }}</td>
                            <td>{{ $pemeriksaan->bb }}</td>
                            <td>{{ $pemeriksaan->tb }} </td>
                            <td>{{ $pemeriksaan->sasaran ? $pemeriksaan->sasaran->kategori : ($pemeriksaan->anak ? 'Anak' : '-') }}</td>
                            
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
                @endif
              </tbody>
            </table>
          </div>

    </section>
</x-layout>