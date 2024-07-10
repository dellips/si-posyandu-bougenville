<style>
  @media (min-width: 1024px) {
    #mobile-menu {
      display: none !important;
    }
  }
</style>
<header class="py-2 px-4 items-left shadow-md">
    <div class="mx-auto py-4">
      <div x-data="{ isOpen: false, isMobile: window.innerWidth < 1024}" @resize.window="isMobile = window.innerWidth < 1024" class="flex flex-row">
        <!-- Mobile menu button -->
        <div class="flex">
          <button @click="if(isMobile) isOpen = !isOpen" type="button" class="relative inline-flex items-center justify-center rounded-md text-black hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2" aria-controls="mobile-menu" aria-expanded="false">
            <span class="sr-only">Open main menu</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg :class="{'hidden': isOpen, 'block': !isOpen }" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg :class="{'block': isOpen, 'hidden': !isOpen }" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
    
        <!-- Mobile menu, show/hide based on menu state. -->
        <div x-show="isOpen" class="space-y-2 px-4 lg:hidden" id="mobile-menu">
            <x-nav-link href="/" :active="request()->is('/')">Dashboard</x-nav-link>
            <p class="mt-6 mb-2 text-sm font-semibold">Data</p>
            <x-nav-link href="/bumil" :active="request()->is('bumil')">Ibu Hamil</x-nav-link>
            <x-nav-link href="/ibu" :active="request()->is('ibu')">Ibu</x-nav-link>
            <x-nav-link href="/balita" :active="request()->is('balita')">Balita</x-nav-link>
            <x-nav-link href="/lansia" :active="request()->is('lansia')">lansia</x-nav-link>
            <p class="mt-6 mb-2 text-sm font-semibold">Kegiatan</p>
            <x-nav-link href="/kegiatan" :active="request()->is('kegiatan')">Tambah Kegiatan</x-nav-link>
            <x-nav-link href="/pelayanan-bumil" :active="request()->is('pelayanan-bumil')">Pelayanan Ibu Hamil</x-nav-link>
            <x-nav-link href="/pelayanan-balita" :active="request()->is('pelayanan-balita')">Pelayanan Balita</x-nav-link>
            <x-nav-link href="/pelayanan-lansia" :active="request()->is('pelayanan-lansia')">Pelayanan Lansia</x-nav-link>
            <x-nav-link href="/laporan-kegiatan" :active="request()->is('laporan-kegiatan')">Laporan Kegiatan</x-nav-link>
            <p class="mt-6 mb-2 text-sm font-semibold">Laporan</p>
            <x-nav-link href="/laporan-bumil" :active="request()->is('laporan-bumil')">Laporan Ibu Hamil</x-nav-link>
            <x-nav-link href="/laporan-balita" :active="request()->is('laporan-balita')">Laporan Balita</x-nav-link>
            <x-nav-link href="/laporan-lansia" :active="request()->is('laporan-lansia')">Laporan Lansia</x-nav-link>
            <p class="mt-6 mb-2 text-sm font-semibold">Pengaturan</p>
            <x-nav-link href="#" :active="request()->is('')">Profile</x-nav-link>
            <x-nav-link href="#" :active="request()->is('')">Sign out</x-nav-link>
        </div>
        <div x-show="!isOpen" class="flex px-4">
          <h1 class="text-center text-xl font-bold tracking-tight text-gray-700 ">{{ $slot }}</h1>
        </div>
      </div>
    </div>
  </header>