<x-layout>
    <x-slot:title>Pemeriksaan PTM</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <div class="flex items-center">
            <a href="/pemeriksaan" class="px-4">
                <svg class="h-6 w-6 text-stone-400 hover:text-stone-800"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                    <path stroke="none" d="M0 0h24v24H0z"/>  
                    <line x1="5" y1="12" x2="19" y2="12" />  
                    <line x1="5" y1="12" x2="9" y2="16" />  
                    <line x1="5" y1="12" x2="9" y2="8" /></svg>
            </a>
            <h1 class="font-semibold text-lg uppercase text-violet-600">Detail Pemeriksaan PTM</h1>
        </div>

        <!-- Modal untuk pesan sukses -->
        <dialog id="success_modal" class="modal">
            <div class="modal-box bg-white text-stone-800">
                <h3 class="text-lg font-bold text-success">Sukses!</h3>
                <p class="py-4">{{ session('success') }}</p>
                <div class="modal-action">
                    <form action="\pemeriksaan\{{ $pemeriksaan->id }}">
                        <button class="btn btn-success">Close</button>
                    </form>
                </div>
            </div>
        </dialog>

        <!-- garis -->
       <div class="divider"></div>

        <h4 class="font-bold mb-4">Data pemeriksaan atas nama: </h4>
        @php
            $url = $pemeriksaan->sasaran ? route('sasaran.show', $pemeriksaan->sasaran->id) : ($pemeriksaan->anak ? route('anak.show', $pemeriksaan->anak->id) : '#');
            $nama = $pemeriksaan->sasaran ? $pemeriksaan->sasaran->nama : ($pemeriksaan->anak ? $pemeriksaan->anak->nama : '-');
        @endphp
        <!-- menuju sasaran detail --> 
        <a href="{{ $url }}" class="mx-6 p-2 font-semibold text-primary hover:text-violet-800">
            {{ $nama }}
        </a>

        <div role="tablist" class="tabs tabs-bordered mt-4">
            <input type="radio" name="my_tabs_1" role="tab" class="tab" aria-label="{{ $pemeriksaan->kegiatan->nm_kegiatan }}" checked="checked"/>
            <div role="tabpanel" class="tab-content p-1">
                <div class="collapse collapse-arrow bg-transparent text-stone-800">
                    <input type="radio" name="my-accordion-1" checked="checked"/>
                    <div class="collapse-content">
                        @if ($pemeriksaan->anak)
                    <!-- Tampilkan data untuk Anak -->
                    <table class="table-fixed m-4 mb-10 text-left w-3/4">
                        <tbody>
                            <tr>
                                <th class="py-1">Berat Badan</th>
                                <th class="py-1">Tinggi Badan</th>
                            </tr>
                            <tr>
                                <td class="px-4 py-1">{{ $pemeriksaan->bb }} kg</td>
                                <td class="px-4 py-1">{{ $pemeriksaan->tb }} cm</td>
                            </tr>
                            <tr>
                                <th class="py-1">Lingkar Kepala</th>
                                <th class="py-1">Lingkar Lengan Atas</th>
                            </tr>
                            <tr>
                                <td class="px-4 py-1">{{ $pemeriksaan->lk }} cm</td>
                                <td class="px-4 py-1">{{ $pemeriksaan->lila }} cm</td>
                            </tr>
                            <tr>
                                <th class="py-1">Panjang Tangan Atas</th>
                                <th class="py-1">Perubahan Berat</th>
                            </tr>
                            <tr>
                                <td class="px-4 py-1">{{ $pemeriksaan->lk }} cm</td>
                                <td class="px-4 py-1">
                                    @php
                                        $perubahanBerat = $pemeriksaan->perubahan_berat; 
                                    @endphp
                                    @if($perubahanBerat)
                                        {{ $perubahanBerat['perubahan'] }}
                                    @else
                                        Tidak Ada Data
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th class="py-1">Status Perubahan Berat</th>
                            </tr>
                            <tr>
                                <td class="px-4 py-1">
                                    @php
                                        $perubahanBerat = $pemeriksaan->perubahan_berat; 
                                    @endphp
                                    @if($perubahanBerat)
                                        {{ ucfirst($perubahanBerat['status']) }}
                                    @else
                                        Tidak Ada Data
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- table pemberian -->
                    <table class="table-fixed m-4 mb-10 text-left w-1/4">
                        <tbody>
                            <tr>
                                <th class="text-lg">Pemberian</th>
                            </tr>
                            <tr>
                                <td>Vitamin A</td>
                                <td>: {{ $pemeriksaan->vit_a }}</td>
                            </tr>
                            <tr>
                                <td>Obat Cacing</td>
                                <td>: {{ $pemeriksaan->obat_cacing }}</td>
                            </tr>
                        </tbody>
                    </table>
                @elseif ($pemeriksaan->sasaran)
                    <!-- Tampilkan data untuk Sasaran -->
                    <table class="table-fixed m-4 mb-10 text-left w-3/4">
                        <tbody>
                            <tr>
                                <th class="py-1">Berat Badan</th>
                                <th class="py-1">Tinggi Badan</th>
                            </tr>
                            <tr>
                                <td class="px-4 py-1">{{ $pemeriksaan->bb }} kg</td>
                                <td class="px-4 py-1">{{ $pemeriksaan->tb }} cm</td>
                            </tr>
                            <tr>
                                <th class="py-1">Lingkar Perut</th>
                                <th class="py-1">Tekanan Darah</th>
                            </tr>
                            <tr>
                                <td class="px-4 py-1">{{ $pemeriksaan->lp }} cm</td>
                                <td class="px-4 py-1">{{ $pemeriksaan->sistolik }}/{{ $pemeriksaan->diastolik }}</td>
                            </tr>
                            <tr>
                                <th class="py-1">Indeks Massa Tubuh (IMT)</th>
                                <th class="py-1">Perubahan Berat</th>
                            </tr>
                            <tr>
                                <td class="px-4 py-1">{{ $pemeriksaan->keterangan }}</td>
                                <td class="px-4 py-1">
                                    @php
                                        $perubahanBerat = $pemeriksaan->perubahan_berat; 
                                    @endphp
                                    @if($perubahanBerat)
                                        {{ $perubahanBerat['perubahan'] }}
                                    @else
                                        Tidak Ada Data
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th></th>
                                <th class="py-1">Status Perubahan Berat</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="px-4 py-1">
                                    @php
                                        $perubahanBerat = $pemeriksaan->perubahan_berat; 
                                    @endphp
                                    @if($perubahanBerat)
                                        {{ ucfirst($perubahanBerat['status']) }}
                                    @else
                                        Tidak Ada Data
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- table pemberian -->
                    <table class="table-fixed m-4 mb-10 text-left w-1/4">
                        <tbody>
                            <tr>
                                <th class="text-lg">Pemberian</th>
                            </tr>
                            <tr>
                                <td>Vitamin A</td>
                                <td>: {{ $pemeriksaan->vit_a }}</td>
                            </tr>
                            <tr>
                                <td>Kapsul Penambah Darah</td>
                                <td>: {{ $pemeriksaan->tambah_darah }}</td>
                            </tr>
                        </tbody>
                    </table>
                @endif
                        <!-- button aksi -->
                        <div class="join flex justify-end w-1/2">
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
                                    <svg class="h-4 w-4 text-stone-800"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <polyline points="3 6 5 6 21 6" />  
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" />  
                                    <line x1="10" y1="11" x2="10" y2="17" />  
                                    <line x1="14" y1="11" x2="14" y2="17" /></svg>
                                </button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
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
</script>