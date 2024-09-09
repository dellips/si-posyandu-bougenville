<x-layout>
  <x-slot:title>Data Akun Pengguna</x-slot:title>
  <section class="m-1 p-8 rounded-lg bg-white">
    <h3 class="m-1 p-2 font-bold text-xl text-violet-600 uppercase">Akun Pengguna</h3>
    <div class="flex items-center justify-between my-4 px-8">
      <!-- Kategori -->
      <div class="flex items-center space-x-4">
        <h3 class="font-semibold text-md text-stone-600">Kategori</h3>
        <select id="filter" class="select select-bordered select-primary bg-transparent text-stone-800">
          <option value="">Kader Posyandu</option>
          <option value="is_admin">Admin</option>
        </select>
      </div>
      
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
    </div>
    
    <!-- Modal untuk pesan sukses -->
    <dialog id="success_modal" class="modal">
      <div class="modal-box bg-white text-stone-800">
        <h3 class="text-lg font-bold text-success">Sukses!</h3>
        <p class="py-4">{{ session('success') }}</p>
        <div class="modal-action">
          <form action="\user">
            <button class="btn btn-s">Close</button>
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
    const filter = this.value;

    fetch(`/users/filter?filter=${filter}`)
        .then(response => response.json())
        .then(data => {
            let tbody = document.querySelector('table tbody');
            tbody.innerHTML = ''; // Kosongkan isi tabel saat ini

            if (data.length > 0) {
                data.forEach((user, index) => {
                    let row = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${user.nama}</td>
                            <td>${calculateAge(user.tgl_lahir)} Tahun</td>
                            <td>${user.posisi}</td>
                            <td>
                                <div class="join">
                                    <a href="/user/${user.id}" class="btn btn-info join-item">
                                        <svg class="h-4 w-4 text-stone-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                            <polyline points="14 2 14 8 20 8"/>
                                            <line x1="16" y1="13" x2="8" y2="13"/>
                                            <line x1="16" y1="17" x2="8" y2="17"/>
                                            <polyline points="10 9 9 9 8 9"/>
                                        </svg>
                                    </a>
                                    <a href="/user/${user.id}/edit" class="btn btn-info join-item">
                                        <svg class="h-4 w-4 text-stone-900" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </a>
                                    <form action="/user/${user.id}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error join-item" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <svg class="h-4 w-4 text-stone-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"/>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                <line x1="10" y1="11" x2="10" y2="17"/>
                                                <line x1="14" y1="11" x2="14" y2="17"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    `;
                    tbody.innerHTML += row;
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="5" class="text-center py-2">Tidak ada data.</td></tr>';
            }
        })
        .catch(error => console.error('Error:', error));
});

function calculateAge(birthdate) {
    const birthDate = new Date(birthdate);
    const age = new Date().getFullYear() - birthDate.getFullYear();
    const m = new Date().getMonth() - birthDate.getMonth();
    return m < 0 || (m === 0 && new Date().getDate() < birthDate.getDate()) ? age - 1 : age;
}

// Default loading for "is_admin" false data
document.addEventListener('DOMContentLoaded', function () {
    var defaultFilter = '';
    var order = 'nama'; // Default sorting column
    var direction = 'asc'; // Default sorting direction

    function fetchData() {
        fetch(`/users/filter?filter=${defaultFilter}&order=${order}&direction=${direction}`)
            .then(response => response.json())
            .then(data => {
                let tbody = document.querySelector('table tbody');
                tbody.innerHTML = '';

                if (data.length > 0) {
                    data.forEach((user, index) => {
                        let row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${user.nama}</td>
                                <td>${calculateAge(user.tgl_lahir)} Tahun</td>
                                <td>${user.posisi}</td>
                                <td>
                                    <div class="join">
                                    <a href="/user/${user.id}" class="btn btn-info join-item">
                                        <svg class="h-4 w-4 text-stone-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                                            <polyline points="14 2 14 8 20 8"/>
                                            <line x1="16" y1="13" x2="8" y2="13"/>
                                            <line x1="16" y1="17" x2="8" y2="17"/>
                                            <polyline points="10 9 9 9 8 9"/>
                                        </svg>
                                    </a>
                                    <a href="/user/${user.id}/edit" class="btn btn-info join-item">
                                        <svg class="h-4 w-4 text-stone-900" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                                        </svg>
                                    </a>
                                    <form action="/user/${user.id}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error join-item" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            <svg class="h-4 w-4 text-stone-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"/>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                                <line x1="10" y1="11" x2="10" y2="17"/>
                                                <line x1="14" y1="11" x2="14" y2="17"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });
                } else {
                    tbody.innerHTML = '<tr><td colspan="5" class="text-center py-2">Tidak ada data.</td></tr>';
                }
            })
            .catch(error => console.error('Error fetching data:', error));
    }

    // Event listener for sorting buttons
    document.querySelectorAll('.sort-btn').forEach(button => {
        button.addEventListener('click', function () {
            order = this.dataset.order;
            direction = this.dataset.direction;
            fetchData();
        });
    });

    fetchData(); // Initial fetch
});



</script>