<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <div m-2 p-1>
    <!--masukin username yang masuk-->
    <p class="font-semibold text-lg">Selamat Datang, !</p>
  </div>
  <section class="grid grid-cols-1 gap-8 p-4  justify-evenly lg:grid-cols-3 xl:grid-cols-3">
    <div class="flex item-center justify-between p-4 bg-white rounded-md">
      <div>
        <h6 class="text-sm font-medium tracking-wider text-gray-500 uppercase">Ibu Hamil</h6>
        <!--masukin jumlah-->
        <span class="font-semibold text-green-600">00</span>
      </div>
      <div>
        <svg class="h-10 w-10 text-gray-400"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path 
          stroke-linecap="round" 
          stroke-linejoin="round" 
          stroke-width="2" 
          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
      </div>
    </div>
    <div class="flex item-center justify-between p-4 bg-white rounded-md">
      <div>
        <h6 class="text-sm font-medium tracking-wider text-gray-500 uppercase">Anak</h6>
        <!--masukin jumlah-->
        <span class="font-semibold text-green-600">00</span>
      </div>
      <div>
        <svg class="h-10 w-10 text-gray-400"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path 
          stroke-linecap="round" 
          stroke-linejoin="round" 
          stroke-width="2" 
          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
      </div>
    </div>
    <div class="flex item-center justify-between p-4 bg-white rounded-md">
      <div>
        <h6 class="text-sm font-medium tracking-wider text-gray-500 uppercase">Lansia</h6>
        <!--masukin jumlah-->
        <span class="font-semibold text-green-600">00</span>
      </div>
      <div>
        <svg class="h-10 w-10 text-gray-400"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path 
          stroke-linecap="round" 
          stroke-linejoin="round" 
          stroke-width="2" 
          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
        </svg>
      </div>
    </div>
  </section>  
  <section class="m-1 p-6 rounded-md bg-white">
    <p class="m-2 p-3 font-semibold text-lg uppercase text-green-600">Kegiatan</p>
    <table class="table-auto min-w-full border-collapse border border-slate-400 rounded-lg overflow-hidden shadow-lg items-center text-center">
      <thead class="bg-">
        <th class="border w-20 border-slate-300">No</th>
        <th class="border border-slate-300">Tanggal</th>
        <th class="border border-slate-300">Nama Kegiatan</th>
        <th class="border border-slate-300">Keterangan</th>
        <th class="border border-slate-300">Aksi</th>
      </thead>
      <tbody id="tableBody-kegiatan">
        <!--isi table-->
        <tr>
          <td class="border px-4 py-2 border-slate-300"> text</td>
        </tr>
      </tbody>
    </table>
  </section>
  <section>
    <!-- Diagram -->
  </section>
</x-layout>