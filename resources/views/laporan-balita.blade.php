<x-layout>
  <x-slot:title>Laporan</x-slot:title>
  <section class="m-1 p-8 rounded-md bg-white">
      <p class="font-semibold text-lg uppercase text-purple-800 mb-8">Laporan Bayi dan Balita</p>
      <form action="" class="mb-8 ">
          <div class="mb-4">
              <label for="start_date" class="block text-gray-800 font-semibold mb-2">Tanggal Mulai</label>
              <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500 text-gray-700">
          </div>
          <div class="mb-4">
              <label for="end_date" class="block text-gray-800 font-semibold mb-2">Tanggal Selesai</label>
              <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-green-500 text-gray-700">
          </div>
          <div class="flex justify-end items-center my-4 mx-8">
              <div class="relative">
                  <a href="{{ route('laporan.lansia.pdf') }}" class="m-2 px-8 py-2 font-semibold text-white rounded-md bg-purple-500 hover:bg-purple-600 flex items-center">
                    <svg class="h-5 w-5 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" />
                      <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                      <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                      <rect x="7" y="13" width="10" height="8" rx="2" />
                    </svg>
                    Cetak
                  </a>
                </div> 
          </div>
      </form>
  </section>
</x-layout>