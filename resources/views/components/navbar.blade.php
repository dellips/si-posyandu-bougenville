<div class="hidden lg:block fixed z-20 inset-0 right-auto w-[18.5rem] pb-10 pl-8 pr-6 pt-6 overflow-y-auto shadow-md">
  <nav id="nav" class="lg:text-sm lg:leading-6 relative">
    <div class="sticky top-0 -ml-0.5 pointer-events-none bg-white">
      <p class="py-2 mt-2 lg:flex items-center font-semibold text-lg text-center">Sistem Informasi Posyandu</p>
      <div class="h-6 border-b border-gray-300"></div>
    </div>
    <ul class="mx-2">
      <li class="mt-6 lg:mt-3">
        <x-nav-link href="/" :active="request()->is('/')">Dashboard</x-nav-link>
      </li>
      <li>
        <h5 class="mt-6 mb-2 lg:mt-3 font-medium">Data</h5>
        <ul class="space-y-6 lg:space-y-2">
          <li>
            <x-nav-link href="/bumil" :active="request()->is('bumil')">Ibu Hamil</x-nav-link>
          </li>
          <li>
            <x-nav-link href="/ibu" :active="request()->is('ibu')">Ibu</x-nav-link>
          </li>
          <li>
            <x-nav-link href="/balita" :active="request()->is('balita')">Balita</x-nav-link>
          </li>
          <li>
            <x-nav-link href="/lansia" :active="request()->is('lansia')">lansia</x-nav-link>
          </li>
        </ul>
      </li>
      <li>
        <h5 class="mt-6 mb-2 lg:mt-3 font-medium">Kegiatan</h5>
        <ul class="space-y-6 lg:space-y-2">
          <li>
            <x-nav-link href="/kegiatan" :active="request()->is('kegiatan')">Tambah Kegiatan</x-nav-link>
          </li>
          <li>
            <x-nav-link href="/pelayanan-bumil" :active="request()->is('pelayanan-bumil')">Pelayanan Ibu Hamil</x-nav-link>
          </li>
          <li>
            <x-nav-link href="/pelayanan-balita" :active="request()->is('pelayanan-balita')">Pelayanan Balita</x-nav-link>
          </li>
          <li>
            <x-nav-link href="/pelayanan-lansia" :active="request()->is('pelayanan-lansia')">Pelayanan Lansia</x-nav-link>
          </li>
        </ul>
      </li>
      <li>
        <h5 class="mt-6 mb-2 lg:mt-3 font-medium">Laporan</h5>
        <ul class="space-y-6 lg:space-y-2">
          <li>
            <x-nav-link href="/laporan-kegiatan" :active="request()->is('laporan-kegiatan')">Laporan Kegiatan</x-nav-link>
          </li>
          <li>
            <x-nav-link href="/laporan-bumil" :active="request()->is('laporan-bumil')">Laporan Ibu Hamil</x-nav-link>
          </li>
          <li>
            <x-nav-link href="/laporan-balita" :active="request()->is('laporan-balita')">Laporan Balita</x-nav-link>
          </li>
          <li>
            <x-nav-link href="/laporan-lansia" :active="request()->is('laporan-lansia')">Laporan Lansia</x-nav-link>
          </li>
        </ul>
      </li>
      <li>
        <h5 class="mt-6 mb-2 lg:mt-3 font-medium">Pengaturan</h5>
        <ul class="space-y-6 lg:space-y-2">
          <li>
            <x-nav-link href="#" :active="request()->is('')">Profile</x-nav-link>
          </li>
          <li>
            <x-nav-link href="#" :active="request()->is('')">Sign out</x-nav-link>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</div>