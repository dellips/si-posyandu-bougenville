<x-layout>
    <x-slot:title>Laporan Kegiatan</x-slot:title>
    <section class="m-1 p-8 rounded-md bg-white">
        <p class="font-semibold text-lg uppercase text-purple-800 mb-8">Laporan Kegiatan Posyandu</p>

        <form action="{{ route('laporan.kegiatan.pdf') }}" method="GET" class="mb-8">
            <!-- Opsi Jenis Laporan -->
            <div class="mb-4">
                <label class="block text-gray-800 font-semibold mb-2">Jenis Laporan</label>
                <div class="flex items-center">
                    <input type="radio" id="by_date" name="report_type" value="date" class="mr-2" checked>
                    <label for="by_date" class="mr-4">Berdasarkan Tanggal</label>
                    
                    <input type="radio" id="by_activity" name="report_type" value="activity" class="mr-2">
                    <label for="by_activity">Berdasarkan Kegiatan</label>
                </div>
            </div>

            <!-- berdasarkan tanggal -->
            <div id="date_inputs" class="mb-4">
                <div class="mb-4">
                    <label for="start_date" class="block text-gray-800 font-semibold mb-2">Tanggal Mulai</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 text-gray-700">
                </div>
                <div class="mb-4">
                    <label for="end_date" class="block text-gray-800 font-semibold mb-2">Tanggal Selesai</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 text-gray-700">
                </div>
            </div>

            <!-- berdasarkan kegiatan -->
            <div id="activity_inputs" class="mb-4 hidden">
                <label for="activity" class="block text-gray-800 font-semibold mb-2">Pilih Kegiatan</label>
                <select id="activity" name="activity" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:border-purple-500 text-gray-700">
                    <option value="" selected disabled>Pilih Kegiatan</option>
                    @foreach($kegiatans as $kegiatan)
            <option value="{{ $kegiatan->id }}">{{ $kegiatan->nm_kegiatan }}</option>
        @endforeach
                </select>
            </div>

            <div class="flex justify-end items-center my-4 mx-8">
                <div class="relative">
                    <button type="submit" class="m-2 px-8 py-2 font-semibold text-white rounded-md bg-purple-500 hover:bg-purple-600 flex items-center">
                        <svg class="h-5 w-5 text-white mr-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" />
                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                            <rect x="7" y="13" width="10" height="8" rx="2" />
                        </svg>
                        Cetak
                    </button>
                </div> 
            </div>
        </form>
    </section>

    <script>
        // JavaScript untuk menampilkan/menghilangkan input berdasarkan jenis laporan
        const byDateRadio = document.getElementById('by_date');
        const byActivityRadio = document.getElementById('by_activity');
        const dateInputs = document.getElementById('date_inputs');
        const activityInputs = document.getElementById('activity_inputs');

        byDateRadio.addEventListener('change', function() {
            if (this.checked) {
                dateInputs.classList.remove('hidden');
                activityInputs.classList.add('hidden');
            }
        });

        byActivityRadio.addEventListener('change', function() {
            if (this.checked) {
                dateInputs.classList.add('hidden');
                activityInputs.classList.remove('hidden');
            }
        });
    </script>
</x-layout>
