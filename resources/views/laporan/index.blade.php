<x-layout>
    <x-slot:title>Laporan Kegiatan</x-slot:title>
    <section class="m-1 p-8 rounded-lg bg-white">
        <h3 class="m-1 p-2 font-bold text-xl text-violet-600 uppercase">Laporan Kegiatan Posyandu</h3>

        <form action="{{ route('laporan.kegiatan.pdf') }}" method="GET" class="my-8">
            <!-- berdasarkan kegiatan -->
            <div id="activity_inputs" class="mb-4">
                <label for="activity" class="block text-gray-800 font-semibold mb-2">Pilih Kegiatan</label>
                <select id="activity" name="activity" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 text-gray-700">
                    <option value="" selected disabled>-- Pilih Kegiatan --</option>
                    @foreach($kegiatans as $kegiatan)
                        <option value="{{ $kegiatan->id }}">{{ $kegiatan->nm_kegiatan }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end items-center my-4 mx-8">
                <div class="relative">
                    <button type="submit" class="btn btn-primary text-white my-2">
                        <svg class="h-5 w-5 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                            <rect x="7" y="13" width="10" height="8" rx="2" /></svg>
                        Cetak
                    </button>
                </div> 
            </div>
        </form>
    </section>
</x-layout>