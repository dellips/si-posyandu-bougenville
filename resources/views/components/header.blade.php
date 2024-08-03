<header class="px-4 py-2 shadow-md bg-white">
  <div class="mx-auto py-4">
    <div x-data="{isOpen: false}" class="relative flex items-center justify-between">
      <!-- Mobile menu button dan judul -->
      <div class="flex items-center">
        <button @click="isOpen = !isOpen" type="button" class="relative inline-flex justify-center text-black lg:hidden hover:text-gray-800" aria-controls="mobile-menu" aria-expanded="false">
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

        <!-- Title, hidden when menu is open -->
        <h1 x-show="!isOpen" class="ml-4 text-xl font-bold tracking-tight text-gray-700 text-center">{{ $slot }}</h1>
      </div>
      
      <!-- Mobile menu, show/hide based on menu state. -->
      <div x-show="isOpen" id="mobile-menu" class="absolute left-0 top-full mt-2 w-full bg-white shadow-lg rounded-lg z-50">
        <div class="divide-y pl-8 lg:hidden">
          <div class="mt-2 space-y-2 pr-7">
            <x-nav-link href="/" :active="request()->is('/')">Dashborad</x-nav-link>
          </div>
          <div x-data="{ isActive: false, open: false}">
            <a href="#" @click="$event.preventDefault(); open = !open" 
            class="flex items-center p-2 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary" 
            :class="{'bg-primary-100 dark:bg-primary': isActive || open}" 
             role="button" aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
             <span class="ml-3"> Data </span>
              <span class="ml-auto" aria-hidden="true">
                <svg
                  class="w-4 h-4 transition-transform transform"
                  :class="{ 'rotate-180': open }"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                   <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                 </svg>
              </span>
            </a>
            <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Data">
              <x-nav-link href="/bumil" :active="request()->is('bumil')" role="menuitem">Ibu Hamil</x-nav-link>
              <x-nav-link href="/ibu" :active="request()->is('ibu')" role="menuitem">Ibu</x-nav-link>
              <x-nav-link href="/balita" :active="request()->is('balita')">Anak</x-nav-link>
              <x-nav-link href="/lansia" :active="request()->is('lansia')">lansia</x-nav-link>
            </div>
          </div>
          <div x-data="{ isActive: false, open: false }">
            <a href="#" @click="$event.preventDefault(); open = !open"
              class="flex items-center p-2 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
              :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }"
              role="button" aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
              <span class="ml-3"> Kegiatan </span>
              <span aria-hidden="true" class="ml-auto">
                <svg
                  class="w-4 h-4 transition-transform transform"
                  :class="{ 'rotate-180': open }"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </span>
            </a>
            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Kegiatan">
              <x-nav-link href="/kegiatan" :active="request()->is('kegiatan')">Tambah Kegiatan</x-nav-link>
              <x-nav-link href="/pelayanan-bumil" :active="request()->is('pelayanan-bumil')">Pelayanan Ibu Hamil</x-nav-link>
              <x-nav-link href="/pelayanan-balita" :active="request()->is('pelayanan-balita')">Pelayanan Anak</x-nav-link>
              <x-nav-link href="/pelayanan-lansia" :active="request()->is('pelayanan-lansia')">Pelayanan Lansia</x-nav-link>
              <x-nav-link href="/laporan-kegiatan" :active="request()->is('laporan-kegiatan')">Laporan Kegiatan</x-nav-link>
            </div>
          </div>
          <div x-data="{ isActive: false, open: false }">
            <a href="#" @click="$event.preventDefault(); open = !open"
              class="flex items-center p-2 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
              :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }"
              role="button" aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
              <span class="ml-3"> Laporan </span>
              <span aria-hidden="true" class="ml-auto">
                <svg
                  class="w-4 h-4 transition-transform transform"
                  :class="{ 'rotate-180': open }"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </span>
            </a>
            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Laporan">
              <x-nav-link href="/laporan-bumil" :active="request()->is('laporan-bumil')">Laporan Ibu Hamil</x-nav-link>
              <x-nav-link href="/laporan-balita" :active="request()->is('laporan-balita')">Laporan Anak</x-nav-link>
              <x-nav-link href="/laporan-lansia" :active="request()->is('laporan-lansia')">Laporan Lansia</x-nav-link>
            </div>
          </div>
          <div x-data="{ isActive: false, open: false }">
            <a href="#" @click="$event.preventDefault(); open = !open"
              class="flex items-center p-2 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
              :class="{ 'bg-primary-100 dark:bg-primary': isActive || open }"
              role="button" aria-haspopup="true" :aria-expanded="(open || isActive) ? 'true' : 'false'">
              <span class="ml-3"> Pengaturan </span>
              <span aria-hidden="true" class="ml-auto">
                <svg
                  class="w-4 h-4 transition-transform transform"
                  :class="{ 'rotate-180': open }"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </span>
            </a>
            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pengaturan">
              <x-nav-link href="/profile" :active="request()->is('profile')">Profile</x-nav-link>
              <x-nav-link href="#" :active="request()->is('')">Sign out</x-nav-link>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>