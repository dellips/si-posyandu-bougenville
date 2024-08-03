<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
      <p class="font-semibold text-lg uppercase text-green-600">{{ $title }}</p>
      <div class="flex justify-between items-center my-4 mx-8">
        <a href="./tambahData" class="m-2 px-8 py-2 font-semibold text-white rounded-md bg-green-500 hover:bg-green-600">
          Tambah Data
        </a>
          
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="w-5 h-5 text-gray-500" viewBox="0 0 24 24" fill="none">
              <path
                d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              </path>
            </svg>
          </span>
          <input class="w-32 pl-10 pr-4 rounded-md form-input sm:w-64 focus:border-green-500" type="text" placeholder="Search">
        </div>
      </div>
      
      <table class="m-2 table-auto min-w-full border-collapse border border-slate-400 rounded-lg overflow-hidden shadow-lg items-center text-center">
        <thead class="bg-">
          <th class="border w-20 border-slate-300">No</th>
          <th class="border border-slate-300">NIK</th>
          <th class="border border-slate-300">Nama Lengkap</th>
          <th class="border border-slate-300">Keterangan</th>
          <th class="border border-slate-300">Aksi</th>
        </thead>
        <tbody id="tableBody-kegiatan">
            <!--isi table-->
          <tr>
            <td class="border px-4 py-2 border-slate-300"></td>
          </tr>
        </tbody>
      </table>
    </section>
  </x-layout>