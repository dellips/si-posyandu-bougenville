<x-layout>
    <x-slot:title>Akun Pengguna</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <div class="flex items-center">
            <a href="/user" class="px-4">
                <svg class="h-6 w-6 text-stone-400 hover:text-stone-800"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
                    <path stroke="none" d="M0 0h24v24H0z"/>  
                    <line x1="5" y1="12" x2="19" y2="12" />  
                    <line x1="5" y1="12" x2="9" y2="16" />  
                    <line x1="5" y1="12" x2="9" y2="8" /></svg>
            </a>
            <h1 class="font-semibold text-lg uppercase text-violet-600">Detail Akun Pengguna</h1>
        </div>
        
       <!-- Modal untuk pesan sukses -->
    <dialog id="success_modal" class="modal">
        <div class="modal-box bg-white text-stone-800">
            <h3 class="text-lg font-bold text-success">Sukses!</h3>
            <p class="py-4">{{ session('success') }}</p>
            <div class="modal-action">
                <form action="\user\{{ $user->id }}">
                    <button class="btn btn-success">Close</button>
                </form>
            </div>
        </div>
    </dialog>

       <!-- garis -->
       <div class="divider"></div>

       <!-- data pengguna -->
       <div class="collapse collapse-arrow bg-transparent text-stone-800">
        <input type="radio" name="my-accordion-1" />
        <div class="collapse-title text-lg font-semibold text-stone-600">Akun Pengguna</div>
        <div class="collapse-content">
            <table class="m-1 mx-4 table-auto text-left">
                <tbody>
                    <tr>
                        <th class="w-1/2 py-1">Username</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{ $user->username }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
      </div>
       <div class="collapse collapse-arrow bg-transparent text-stone-800">
        <input type="radio" name="my-accordion-1" checked="checked" />
        <div class="collapse-title text-lg font-semibold text-stone-600">Data Pengguna</div>
        <div class="collapse-content">
            <table class="m-1 mx-4 table-auto text-left">
                <tbody>
                    <tr>
                        <th class="w-1/2 py-1">NIK</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{ $user->nik }}</td>
                    </tr>
                    <tr>
                        <th class="w-1/2 py-1">Nama</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{ $user->nama }}</td>
                    </tr>
                    <tr>
                        <th class="w-1/2 py-1">Tanggal Lahir</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{ \Carbon\Carbon::parse($user->tgl_lahir)->format('d F o') }}</td>
                    </tr>
                    <tr>
                        <th class="w-1/2 py-1">Usia</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{ $usia }} Tahun</td>
                    </tr>
                    <tr>
                        <th class="w-1/2 py-1">Jenis Kelamin</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{ $user->jk }}</td>
                    </tr>
                    <tr>
                        <th class="w-1/2 py-1">Alamat</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{ $user->alamat }} RT {{ $user->rt }} RW {{ $user->rw }}</td>
                    </tr>
                    <tr>
                        <th class="w-1/2 py-1">Nomor Telephone</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{ $user->no_telp }}</td>
                    </tr>
                    <tr>
                        <th class="w-1/2 py-1">Posisi</th>
                        <td class="px-2 py-1">:</td>
                        <td class="px-4 py-1">{{ $user->posisi }}</td>
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