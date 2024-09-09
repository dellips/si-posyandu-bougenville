<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
      <h1 class="font-semibold text-lg uppercase text-violet-600">Profile</h1>
      <table class="m-5 table-auto text-left text-stone-800">
          <tbody>
            <tr>
              <th class="w-1/2 py-1">Username</th>
              <td class="px-2 py-1">:</td>
              <td class="px-4 py-1">{{ auth()->user()->username }}</td>
            </tr>
              <tr>
                  <th class="w-1/2 py-1">NIK</th>
                  <td class="px-2 py-1">:</td>
                  <td class="px-4 py-1">{{ auth()->user()->nik }}</td>
              </tr>
              <tr>
                  <th class="w-1/2 py-1">Nama</th>
                  <td class="px-2 py-1">:</td>
                  <td class="px-4 py-1">{{ auth()->user()->nama }}</td>
              </tr>
              <tr>
                  <th class="w-1/2 py-1">Alamat</th>
                  <td class="px-2 py-1">:</td>
                  <td class="px-4 py-1">{{ auth()->user()->alamat }} RT {{ auth()->user()->rt }} RW {{ auth()->user()->rw }}</td>
              </tr>
              <tr>
                  <th class="w-1/2 py-1">Tanggal Lahir</th>
                  <td class="px-2 py-1">:</td>
                  <td class="px-4 py-1">{{ \Carbon\Carbon::parse( auth()->user()->tgl_lahir )->format('d F o') }}</td>
              </tr>
              <tr>
                  <th class="w-1/2 py-1">Usia</th>
                  <td class="px-2 py-1">:</td>
                  <td class="px-4 py-1">{{ \Carbon\Carbon::parse( auth()->user()->tgl_lahir )->age }} Tahun</td>
              </tr>
              <tr>
                  <th class="w-1/2 py-1">Nomor Telephone</th>
                  <td class="px-2 py-1">:</td>
                  <td class="px-4 py-1">{{ auth()->user()->no_telp }}</td>
              </tr>
          </tbody>
      </table>
      <div class="flex items-center space-x-4 m-1 mx-5">
        <span class="text-lg font-semibold text-stone-600">Aksi</span>
      </div>
      <div class="flex justify-end w-1/2">
        <a href="{{ route('user.edit', auth()->user()->id) }}" class="btn btn-info join-item">
            <svg 
            class="h-4 w-4 text-stone-900"  width="24"  height="24"  viewBox="0 0 24 24"  xmlns="http://www.w3.org/2000/svg"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  
            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />  
            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg>
        </a>
    </div>
  </section>
  </x-layout>