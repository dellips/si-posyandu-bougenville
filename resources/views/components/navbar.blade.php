<div class="fixed left-0 top-0 w-[19rem] h-full mx-auto lg:block z-20 inset-0 right-auto pd-10 overflow-auto bg-white shadow">
  <nav class="m-4 flex items-center lg:text-sm lg:leading-6 relative" x-data="{ isOpen: false }">
    <div class="hidden md:block">
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
    </div>
              
    <div class="-mr-2 flex md:hidden">
      <!-- Mobile menu button -->
      <button  @click="isOpen = !isOpen" type="button" class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" aria-controls="mobile-menu" aria-expanded="false">
            <span class="absolute -inset-0.5"></span>
            <span class="sr-only">Open main menu</span>
            <!-- Menu open: "hidden", Menu closed: "block" -->
            <svg :class="{'hidden': isOn, 'block': !isOn }" class="block h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <!-- Menu open: "block", Menu closed: "hidden" -->
            <svg :class="{'block': isOn, 'hidden': !isOn }" class="hidden h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-show="isOpen" class="md:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2 sm:px-3">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Dashboard</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
        <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Reports</a>
      </div>
      <div class="border-t border-gray-700 pb-3 pt-4">
        <div class="flex items-center px-5">
          <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="">
          </div>
          <div class="ml-3">
            <div class="text-base font-medium leading-none text-white">Tom Cook</div>
          </div>
          <button type="button" class="relative ml-auto flex-shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
            <span class="absolute -inset-1.5"></span>
            <span class="sr-only">View notifications</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
          </button>
        </div>
        <div class="mt-3 space-y-1 px-2">
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your Profile</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
          <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign out</a>
        </div>
      </div>
    </div>
  </nav>
</div>