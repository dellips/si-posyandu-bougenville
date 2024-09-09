<x-layout>
    <x-slot:title>Data Sasaran Posyandu</x-slot:title>
    <section class="m-1 p-8 rounded-lg bg-white">
        <h3 class="m-1 p-2 font-bold text-xl text-violet-600 uppercase">Sasaran Posyandu</h3>
    
        <!-- Modal untuk pesan sukses -->
        <dialog id="success_modal" class="modal">
            <div class="modal-box bg-white text-stone-800">
                <h3 class="text-lg font-bold text-success">Sukses!</h3>
                <p class="py-4">{{ session('success') }}</p>
                <div class="modal-action">
                    <form action="\sasaran">
                        <button class="btn btn-success">Close</button>
                    </form>
                </div>
            </div>
        </dialog>
        
            <!-- tambah data -->
            <div class="flex justify-end space-x-4">
                <a href="/sasaran/create" class="btn btn-primary text-white flex items-center space-x-2">
                    <svg class="h-4 w-4 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                        <path stroke="none" d="M0 0h24v24H0z"/>  
                        <line x1="12" y1="5" x2="12" y2="19" />  
                        <line x1="5" y1="12" x2="19" y2="12" /></svg>
                    <span>Tambah Data</span>
                </a>    
                <a href="/anak/create" class="btn btn-primary text-white flex items-center space-x-2">
                    <svg class="h-4 w-4 text-white" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                        <path stroke="none" d="M0 0h24v24H0z"/>  
                        <line x1="12" y1="5" x2="12" y2="19" />  
                        <line x1="5" y1="12" x2="19" y2="12" /></svg>
                    <span>Tambah Data Anak</span>
                </a>  
            </div>     
        
      <div role="tablist" class="tabs tabs-bordered">
        @foreach (['Semua Data' => $sasarans, 'Ibu Hamil' => $sasarans->where('kategori', 'Ibu Hamil'), 'Ibu dan Anak' => $sasarans->where('kategori', 'Ibu'), 'Lansia' => $sasarans->where('kategori', 'Lansia')] as $label => $filteredSasarans)
            <!-- Radio button for each tab -->
            <input type="radio" name="my_tabs_1" role="tab" class="tab hover:font-semibold" aria-label="{{ $label }}" {{ $activeTab === $label ? 'checked="checked"' : '' }} />
    
            <!-- Content for each tab -->
            <div role="tabpanel" class="tab-content p-4">
                <div class="overflow-x-auto">
                    <table class="table table-md m-2">
                        <thead class="text-stone-700 font-semibold text-base text-center">
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
                            @if ($label === 'Ibu dan Anak')
                            <th>
                                <div class="flex justify-between items-center">
                                    <span class="mx-auto">Nama Anak</span>
                                </div>
                            </th>
                            @endif
                            <th>Status BPJS</th>
                            @if ($label === 'Semua Data')
                            <th>
                                <div class="flex justify-between items-center">
                                    <span class="mx-auto">Kategori</span>
                                </div>
                            </th>
                            @endif
                            <th>Aksi</th>
                        </thead>
                        <tbody class="text-stone-600 text-center">
                            @if ($filteredSasarans->isEmpty())
                                <tr>
                                    <td colspan="{{ $label === 'Ibu dan Anak' || $label === 'Semua Data' ? '6' : '5' }}" class="text-center py-2">Tidak ada data.</td>
                                </tr>
                            @else
                                @foreach ($filteredSasarans as $sasaran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sasaran->nama }}</td>
                                        <td>{{ \Carbon\Carbon::parse($sasaran->tgl_lahir)->age }} Tahun</td>
                                        @if ($label === 'Ibu dan Anak')
                                        <td>
                                            @if($sasaran->anak->isNotEmpty())
                                                @foreach($sasaran->anak as $anak)
                                                    <p>{{ $anak->nama }}</p>
                                                @endforeach
                                            @else
                                                Tidak ada data
                                            @endif
                                        </td>
                                        @endif
                                        <td>{{ $sasaran->status_bpjs }}</td>
                                        @if ($label === 'Semua Data')
                                        <td>{{ $sasaran->kategori }}</td>
                                        @endif
                                        <td>
                                            <div class="join">
                                                <a href="{{ route('sasaran.show', $sasaran->id) }}" class="btn btn-info join-item">
                                                    <svg class="h-4 w-4 text-stone-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">  
                                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />  
                                                        <polyline points="14 2 14 8 20 8" />  
                                                        <line x1="16" y1="13" x2="8" y2="13" />  
                                                        <line x1="16" y1="17" x2="8" y2="17" />  
                                                        <polyline points="10 9 9 9 8 9" /></svg>
                                                </a>
                                                <a href="{{ route('sasaran.edit', $sasaran->id) }}" class="btn btn-info join-item">
                                                    <svg class="h-4 w-4 text-stone-900" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">  
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />  
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
                                                </a>
                                                <form action="{{ route('sasaran.destroy', $sasaran->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-error join-item" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <svg class="h-4 w-4 text-stone-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">  
                                                            <polyline points="3 6 5 6 21 6" />  
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
            </div>
        @endforeach
    </div>
    
    

    </section>
</x-layout>

<script>
    @if (session('success'))
        window.onload = function() {
            document.getElementById('success_modal').showModal();
        }
    @endif

    document.querySelectorAll('.sort-btn').forEach(button => {
    button.addEventListener('click', function() {
        const order = this.getAttribute('data-order');
        const direction = this.getAttribute('data-direction');
        const activeTab = document.querySelector('input[name="my_tabs_1"]:checked').getAttribute('aria-label');  // Ambil tab aktif

        const url = new URL(window.location.href);
        url.searchParams.set('order', order);
        url.searchParams.set('direction', direction);
        url.searchParams.set('activeTab', activeTab);  // Tambahkan tab aktif ke URL

        window.location.href = url.toString();  // Redirect dengan parameter sorting dan tab aktif
    });
});

document.querySelectorAll('input[name="my_tabs_1"]').forEach(tab => {
    tab.addEventListener('click', function() {
        const activeTab = this.getAttribute('aria-label');
        const url = new URL(window.location.href);
        url.searchParams.set('activeTab', activeTab);  // Set tab aktif ketika tab diklik
        window.history.replaceState(null, '', url);  // Perbarui URL tanpa reload halaman
    });
});


</script>