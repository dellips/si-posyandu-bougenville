<x-layout>
  <x-slot:title>Dashboard</x-slot:title>
  <!-- untuk admin -->
  @if (auth()->user()->is_admin)
  <div class="card bg-gradient-to-r from-purple-300 from-10% via-violet-400 via-30% to-indigo-500 to-90% rounded-box grid place-items-center p-2 max-h-64">
    <div class="hero-content flex-col lg:flex-row lg:items-center h-auto lg:h-32">
      <!-- Tanggal dan Teks -->
      <div class="flex flex-col space-y-2 text-left">
        <p id="current-date" class="text-gray-700"></p>
        <h1 class="text-2xl font-bold text-gray-800">Posyandu Bougenville Rancanumpang</h1>
        <h3 class="text-lg font-semibold text-gray-800">Selamat Datang, Admin!</h3>
      </div>
      <!-- Gambar -->
      <img src="/img/green-branch-with-pink-flowers.png" class="max-w-sm lg:ml-6 max-h-32" />
    </div>
  </div>

  <!-- card jumlah -->
  <section class="grid grid-cols-1 gap-4 my-4  justify-evenly lg:grid-cols-4 xl:grid-cols-4">
    <div class="flex item-center justify-between p-6 bg-white rounded-lg">
      <div>
        <h6 class="text-sm font-medium tracking-wider uppercase">Kader Posyandu</h6>
        <span class="font-semibold text-violet-600">{{ $jml_kader }}</span>
      </div>
      <div>
        <svg class="h-10 w-10 text-primary"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
          <path stroke="none" d="M0 0h24v24H0z"/>  
          <circle cx="12" cy="12" r="9" />  
          <line x1="9" y1="10" x2="9.01" y2="10" />  
          <line x1="15" y1="10" x2="15.01" y2="10" />  
          <path d="M9.5 15a3.5 3.5 0 0 0 5 0" /></svg>
      </div>
    </div>
    <div class="flex item-center justify-between p-6 bg-white rounded-lg">
      <div>
        <h6 class="text-sm font-medium tracking-wider uppercase">Ibu Hamil</h6>
        <span class="font-semibold text-violet-600">{{ $jml_ibuHamil }}</span>
      </div>
      <div>
        <svg 
          class="h-10 w-10 text-primary"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
          <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="12" r="9" />  
          <line x1="9" y1="9" x2="9.01" y2="9" />  <line x1="15" y1="9" x2="15.01" y2="9" />  
          <circle cx="12" cy="15" r="2" /></svg>
      </div>
    </div>
    <div class="flex item-center justify-between p-6 bg-white rounded-lg">
      <div>
        <h6 class="text-sm font-medium tracking-wider uppercase">Bayi dan Balita</h6>
        <span class="font-semibold text-violet-600">{{ $jml_anak }}</span>
      </div>
      <div>
        <svg class="h-10 w-10 text-primary"  
          width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
          <path stroke="none" d="M0 0h24v24H0z"/>  
          <circle cx="12" cy="12" r="9" />  
          <line x1="9" y1="10" x2="9.01" y2="10" />  
          <line x1="15" y1="10" x2="15.01" y2="10" />  
          <path d="M9.5 15a3.5 3.5 0 0 0 5 0" />  
          <path d="M12 3a2 2 0 0 0 0 4" /></svg>
      </div>
    </div>
    <div class="flex item-center justify-between p-6 bg-white rounded-lg">
      <div>
        <h6 class="text-sm font-medium tracking-wider uppercase">Lansia</h6>
        <span class="font-semibold text-violet-600">{{ $jml_lansia }}</span>
      </div>
      <div>
        <svg 
          class="h-10 w-10 text-primary"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
          <path stroke="none" d="M0 0h24v24H0z"/>  
          <circle cx="12" cy="12" r="9" />  
          <line x1="9" y1="9" x2="9.01" y2="9" />  
          <line x1="15" y1="9" x2="15.01" y2="9" />  
          <path d="M8 13a4 4 0 1 0 8 0m0 0H8" /></svg>
      </div>
    </div>
  </section>  

  <!-- section kegiatan -->
  <div class="flex m-1 justify-evenly">
    <section class="p-4 mr-2 w-1/2 rounded-lg bg-white">
      <div class="flex items-center justify-between my-4">
        <h3 class="m-2 p-3 font-bold text-xl text-primary">Kegiatan Posyandu</h3>
        <select id="filter" class="select select-bordered select-primary w-full max-w-xs bg-transparent text-stone-800">
          <option value="today">Hari ini</option>
          <option value="month">Bulan ini</option>
          <option value="year">Tahun ini</option>
          <option value="">Semua Data</option>
      </select>
      </div>
      <!-- table -->
      <div class="overflow-x-auto">
        <table class="table table-md m-2">
          <thead class=" font-semibold text-base text-stone-800">
            <th></th>
            <th>Nama Kegiatan</th>
            <th>Tanggal Kegiatan</th>
            <th>Aksi</th>
          </thead>
          <tbody  class="text-stone-600">
            @if (!$kegiatanToday->isEmpty())
            @foreach ($kegiatanToday as $kegiatan)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $kegiatan->nm_kegiatan }}</td>
              <td>{{ \Carbon\Carbon::parse($kegiatan->tgl_kegiatan)->format('d F o') }}</td>
              <td>
                <a href="/kegiatan/${kegiatan.id}" class="btn btn-info">
                  <svg 
                    class="h-4 w-4 text-stone-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />  
                    <polyline points="14 2 14 8 20 8" />  
                    <line x1="16" y1="13" x2="8" y2="13" />  
                    <line x1="16" y1="17" x2="8" y2="17" />  
                    <polyline points="10 9 9 9 8 9" /></svg>
                  </a>
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="4" class="text-center py-2">Tidak ada kegiatan.</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </section>
    <!-- grafik -->
    <section class="p-4 ml-2 w-1/2 rounded-md bg-white">
      <h3 class="m-2 p-3 font-bold text-xl text-primary">Jumlah Pemeriksaan</h3>
      <div class="m-2 p-4">
        <canvas id="pemeriksaanChart" width="400" height="200"></canvas>
  
        <script>
          var kegiatanNames = @json($pemeriksaanPerKegiatan->keys());
          var pemeriksaanCounts = @json($pemeriksaanPerKegiatan->values());
        
          const ctx = document.getElementById('pemeriksaanChart').getContext('2d');
          const myChart = new Chart(ctx, {
              type: 'line', 
              data: {
                  labels: kegiatanNames,
                  datasets: [{
                      label: 'Jumlah Pemeriksaan per Kegiatan',
                      data: pemeriksaanCounts,
                      backgroundColor: 'rgba(75, 192, 192, 0.2)',
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          });
        </script>
      </div>
    </section>
  </div>

  <!-- untuk pengguna -->
  @else
  <div class="card bg-gradient-to-r from-purple-300 from-10% via-violet-400 via-30% to-indigo-500 to-90% rounded-box grid place-items-center p-2 max-h-64">
    <div class="hero-content flex-col lg:flex-row lg:items-center h-auto lg:h-32">
      <!-- Tanggal dan Teks -->
      <div class="flex flex-col space-y-2 text-left">
        <p id="current-date" class="text-gray-700"></p>
        <h1 class="text-2xl font-bold text-gray-800">Posyandu Bougenville Rancanumpang</h1>
        <h3 class="text-lg font-semibold text-gray-800">Selamat Datang, {{ auth()->user()->nama }}!</h3>
      </div>
      <!-- Gambar -->
      <img src="/img/green-branch-with-pink-flowers.png" class="max-w-sm lg:ml-6 max-h-32" />
    </div>
  </div>
  
  <!-- card jumlah -->
  <section class="grid grid-cols-1 gap-4 my-4  justify-evenly lg:grid-cols-3 xl:grid-cols-3">
    <div class="flex item-center justify-between p-6 bg-white rounded-lg">
      <div>
        <h6 class="text-sm font-medium tracking-wider uppercase">Ibu Hamil</h6>
        <span class="font-semibold text-violet-600">{{ $jml_ibuHamil }}</span>
      </div>
      <div>
        <svg 
          class="h-10 w-10 text-primary"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
          <path stroke="none" d="M0 0h24v24H0z"/>  <circle cx="12" cy="12" r="9" />  
          <line x1="9" y1="9" x2="9.01" y2="9" />  <line x1="15" y1="9" x2="15.01" y2="9" />  
          <circle cx="12" cy="15" r="2" /></svg>
      </div>
    </div>
    <div class="flex item-center justify-between p-6 bg-white rounded-lg">
      <div>
        <h6 class="text-sm font-medium tracking-wider uppercase">Bayi dan Balita</h6>
        <span class="font-semibold text-violet-600">{{ $jml_anak }}</span>
      </div>
      <div>
        <svg class="h-10 w-10 text-primary"  
          width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
          <path stroke="none" d="M0 0h24v24H0z"/>  
          <circle cx="12" cy="12" r="9" />  
          <line x1="9" y1="10" x2="9.01" y2="10" />  
          <line x1="15" y1="10" x2="15.01" y2="10" />  
          <path d="M9.5 15a3.5 3.5 0 0 0 5 0" />  
          <path d="M12 3a2 2 0 0 0 0 4" /></svg>
      </div>
    </div>
    <div class="flex item-center justify-between p-6 bg-white rounded-lg">
      <div>
        <h6 class="text-sm font-medium tracking-wider uppercase">Lansia</h6>
        <span class="font-semibold text-violet-600">{{ $jml_lansia }}</span>
      </div>
      <div>
        <svg 
          class="h-10 w-10 text-primary"  width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">  
          <path stroke="none" d="M0 0h24v24H0z"/>  
          <circle cx="12" cy="12" r="9" />  
          <line x1="9" y1="9" x2="9.01" y2="9" />  
          <line x1="15" y1="9" x2="15.01" y2="9" />  
          <path d="M8 13a4 4 0 1 0 8 0m0 0H8" /></svg>
      </div>
    </div>
  </section>    
  
  <!-- section kegiatan -->
  <div class="flex m-1 justify-evenly">
    <section class="p-4 mr-2 w-1/2 rounded-lg bg-white">
      <div class="flex items-center justify-between my-4">
        <h3 class="m-2 p-3 font-bold text-xl text-primary">Kegiatan Posyandu</h3>
        <select id="filter" class="select select-bordered select-primary w-full max-w-xs bg-transparent text-stone-800">
          <option value="today">Hari ini</option>
          <option value="month">Bulan ini</option>
          <option value="year">Tahun ini</option>
          <option value="">Semua Data</option>
      </select>
      </div>
      <!-- table -->
      <div class="overflow-x-auto">
        <table class="table table-md m-2">
          <thead class=" font-semibold text-base text-stone-800">
            <th></th>
            <th>Nama Kegiatan</th>
            <th>Tanggal Kegiatan</th>
            <th>Aksi</th>
          </thead>
          <tbody class="text-stone-600">
            @if (!$kegiatanToday->isEmpty())
            @foreach ($kegiatanToday as $kegiatan)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $kegiatan->nm_kegiatan }}</td>
              <td>{{ \Carbon\Carbon::parse($kegiatan->tgl_kegiatan)->format('d F o') }}</td>
              <td>
                <a href="/kegiatan/${kegiatan.id}" class="btn btn-info">
                  <svg 
                    class="h-4 w-4 text-stone-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />  
                    <polyline points="14 2 14 8 20 8" />  
                    <line x1="16" y1="13" x2="8" y2="13" />  
                    <line x1="16" y1="17" x2="8" y2="17" />  
                    <polyline points="10 9 9 9 8 9" /></svg>
                  </a>
              </td>
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="4" class="text-center py-2">Tidak ada kegiatan.</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
    </section>
    <!-- grafik -->
    <section class="p-4 ml-2 w-1/2 rounded-md bg-white">
      <h3 class="m-2 p-3 font-bold text-xl text-primary">Jumlah Pemeriksaan</h3>
      <div class="m-2 p-4">
        <canvas id="pemeriksaanChart" width="400" height="200"></canvas>
  
        <script>
          var kegiatanNames = @json($pemeriksaanPerKegiatan->keys());
          var pemeriksaanCounts = @json($pemeriksaanPerKegiatan->values());
        
          const ctx = document.getElementById('pemeriksaanChart').getContext('2d');
          const myChart = new Chart(ctx, {
              type: 'line', 
              data: {
                  labels: kegiatanNames,
                  datasets: [{
                      label: 'Jumlah Pemeriksaan per Kegiatan',
                      data: pemeriksaanCounts,
                      backgroundColor: 'rgba(75, 192, 192, 0.2)',
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          });
        </script>
      </div>
    </section>
  </div>
  @endif
</x-layout>

<!-- script -->
<script>
  // Dapatkan elemen dengan ID 'current-date'
  const dateElement = document.getElementById('current-date');
  
  // Buat objek Date baru
  const today = new Date();
  
  // Format tanggal ke dalam format yang diinginkan, misalnya: 2 September 2024
  const options = { year: 'numeric', month: 'long', day: 'numeric' };
  const formattedDate = today.toLocaleDateString('id-ID', options);
  
  // Tampilkan tanggal di elemen
  dateElement.textContent = formattedDate;

  //filter tabel
  document.getElementById('filter').addEventListener('change', function () {
        const filterValue = this.value;
        fetch(`/filter?filter=${filterValue}`)
            .then(response => response.json())
            .then(data => {
                // Update table content
                let tbody = document.querySelector('table tbody');
                tbody.innerHTML = ''; // Clear current table content

                if (data.length > 0) {
                    data.forEach((kegiatan, index) => {
                        let row = `<tr>
                                    <td>${index + 1}</td>
                                    <td>${kegiatan.nm_kegiatan}</td>
                                    <td>${new Date(kegiatan.tgl_kegiatan).toLocaleDateString()}</td>
                                    <td>
                                      <a href="/kegiatan/${kegiatan.id}" class="btn btn-info">
                                        <svg 
                                          class="h-4 w-4 text-stone-900"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
                                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />  
                                          <polyline points="14 2 14 8 20 8" />  
                                          <line x1="16" y1="13" x2="8" y2="13" />  
                                          <line x1="16" y1="17" x2="8" y2="17" />  
                                          <polyline points="10 9 9 9 8 9" /></svg>
                                        </a>
                                    </td>
                                   </tr>`;
                        tbody.innerHTML += row;
                    });
                } else {
                tbody.innerHTML = '<tr><td colspan="4" class="text-center py-2 text-stone-600">Tidak ada kegiatan.</td></tr>';
            }
          });
  });

//filter grafik
document.getElementById('filter').addEventListener('change', function () {
    var selectedFilter = this.value;

    // Fetch data from server based on the selected filter
    fetch(`/filter-kegiatan?filter=${selectedFilter}`)
        .then(response => response.json())
        .then(data => {
            // Extract data for chart
            var kegiatanNames = data.map(item => item.nm_kegiatan);
            var pemeriksaanCounts = data.map(item => item.jumlah_pemeriksaan);

            // Update chart
            myChart.data.labels = kegiatanNames;
            myChart.data.datasets[0].data = pemeriksaanCounts;
            myChart.update();
})
        .catch(error => console.error('Error fetching data:', error));
});

// Default loading for "Hari ini" data
document.addEventListener('DOMContentLoaded', function () {
    var defaultFilter = 'today';
    fetch(`/filter-kegiatan?filter=${defaultFilter}`)
        .then(response => response.json())
        .then(data => {
            var kegiatanNames = data.map(item => item.nm_kegiatan);
            var pemeriksaanCounts = data.map(item => item.jumlah_pemeriksaan);

            myChart.data.labels = kegiatanNames;
            myChart.data.datasets[0].data = pemeriksaanCounts;
            myChart.update();
})
        .catch(error => console.error('Error fetching data:', error));
});

</script>