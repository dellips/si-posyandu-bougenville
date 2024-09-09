
<header class="sticky top-0 px-4 py-2 shadow-md bg-white z-10">
  <!-- Untuk admin -->
  @if (auth()->user()->is_admin)
  <div class="drawer">
    <!-- Drawer toggle input -->
    <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
  
    <!-- Drawer content -->
    <div class="drawer-content flex flex-col">
      <!-- Navbar -->
      <div class="navbar bg-white w-full px-4 py-2">
        <div class="flex-none lg:hidden">
          <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              class="inline-block h-6 w-6 stroke-current">
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
          </label>
        </div>
        <div class="mx-2 flex-1 px-2">
          <!-- Title, hidden when menu is open -->
          <h1 class="text-xl font-bold tracking-tight text-gray-700">{{ $slot }}</h1>
        </div>
        <x-search></x-search>
      </div>
    </div>
  
    <!-- Sidebar -->
    <div class="drawer-side">
      <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label>
      <ul class="bg-white min-h-full w-80 p-4">
        <!-- Sidebar content here -->
        <ul class="m-2 divide-y">
          <li class="my-4 lg:mt-3">
            <x-nav-link route-pattern="dashboard" href="{{ route('dashboard') }}">Dashboard</x-nav-link>
          </li>
          <li class="my-4">
            <h5 class="mt-6 mb-2 lg:mt-3 font-medium text-primary">Data</h5>
            <ul class="space-y-6 lg:space-y-2">
              <li class="my-2">
                <x-nav-link route-pattern="user.*" href="{{ route('user.index') }}">Akun Pengguna</x-nav-link>
              </li>
              <li class="my-2">
                <x-nav-link route-pattern="ibu.*" href="{{ route('ibu.index') }}">Ibu</x-nav-link>
              </li>
              <li class="my-2">
                <x-nav-link route-pattern="anak.*" href="{{ route('anak.index') }}">Bayi dan Balita</x-nav-link>
              </li>
              <li class="my-2">
                <x-nav-link route-pattern="lansia.*|create" href="{{ route('lansia.index') }}">lansia</x-nav-link>
              </li>
            </ul>
          </li>
          <li class="my-4">
            <h5 class="mt-6 mb-2 lg:mt-3 font-medium text-primary">Kegiatan</h5>
            <ul class="space-y-6 lg:space-y-2">
              <li class="my-2">
                <x-nav-link route-pattern="kegiatan.*" href="{{ route('kegiatan.index') }}">Data Kegiatan</x-nav-link>
              </li>
              <li class="my-2">
                <x-nav-link route-pattern="pemeriksaan.*" href="{{ route('pemeriksaan.index') }}">Pemeriksaan PTM</x-nav-link>
              </li>
            </ul>
          </li>
          <li class="my-4">
            <h5 class="mt-6 mb-2 lg:mt-3 font-medium text-primary">Laporan</h5>
            <ul class="space-y-6 lg:space-y-2">
              <li class="my-2">
                <x-nav-link route-pattern="laporan.*" href="{{ route('laporan.index') }}">Laporan Kegiatan</x-nav-link>
              </li>
              <li class="my-2">
                <x-nav-link href="/laporan-bumil" :active="request()->is('laporan-bumil')">Laporan Ibu Hamil</x-nav-link>
              </li>
              <li class="my-2">
                <x-nav-link href="/laporan-balita" :active="request()->is('laporan-balita')">Laporan Anak</x-nav-link>
              </li>
              <li class="my-2">
                <x-nav-link href="/laporan-lansia" :active="request()->is('laporan-lansia')">Laporan Lansia</x-nav-link>
              </li>
            </ul>
          </li>
          <li class="my-4">
            <h5 class="mt-6 mb-2 lg:mt-3 font-medium text-primary">Pengaturan</h5>
            <ul class="space-y-6 lg:space-y-2">
              <li class="my-2">
                <x-nav-link route-pattern="profile" href="{{ route('profile') }}">Profile</x-nav-link>
              </li>
              <li class="my-2">
                <form method="POST" action="{{ route('logout') }}" class="inline">
                  @csrf
                  <x-nav-link href="#" :active="request()->is('logout')"
                              onclick="event.preventDefault(); this.closest('form').submit();">
                      Sign out
                  </x-nav-link>
              </form>
              </li>
            </ul>
          </li>
        </ul>
      </ul>
    </div>
  </div>
  

  <!-- Untuk pengguna -->
  @else
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
        <h1 x-show="!isOpen" class="ml-4 text-xl font-bold tracking-tight text-gray-700">{{ $slot }}</h1>
      </div>
      
      <x-search></x-search>
      
      <!-- Mobile menu, show/hide based on menu state. -->
      <div x-show="isOpen" id="mobile-menu" class="absolute left-0 top-full mt-2 w-full shadow-lg rounded-lg z-50">
        <div class="divide-y pl-8 lg:hidden bg-white">
          <div class="mt-2 space-y-2 pr-7">
            <x-nav-link route-pattern="dashboard" href="{{ route('dashboard') }}">Dashborad</x-nav-link>
          </div>
          <div x-data="{ isActive: false, open: false}">
            <a href="#" @click="$event.preventDefault(); open = !open" 
            class="flex items-center p-1 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary" 
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
                  stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                 </svg>
              </span>
            </a>
            <div role="menu" x-show="open" class="mt-2 space-y-2 px-7" aria-label="Data">
              <ul>
                <li class="my-2">
                  <x-nav-link route-pattern="ibu.*" href="{{ route('ibu.index') }}">Ibu</x-nav-link>
                </li>
                <li class="my-2">
                  <x-nav-link route-pattern="anak.*" href="{{ route('anak.index') }}">Bayi dan Balita</x-nav-link>
                </li>
                <li class="my-2">
                  <x-nav-link route-pattern="lansia.*" href="{{ route('lansia.index') }}">Lansia</x-nav-link>
                </li>
              </ul>
          
            </div>
          </div>
          <div x-data="{ isActive: false, open: false }">
            <a href="#" @click="$event.preventDefault(); open = !open"
              class="flex items-center p-1 text-gray-800 transition-colors rounded-md dark:text-light hover:bg-primary-100 dark:hover:bg-primary"
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
                  stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </span>
            </a>
            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Kegiatan">
              <ul>
                <li class="my-2">
                  <x-nav-link route-pattern="kegiatan.*" href="{{ route('kegiatan.index') }}">Data Kegiatan</x-nav-link>
                </li>
                <li class="my-2">
                  <x-nav-link route-pattern="pemeriksaan.*" href="{{ route('pemeriksaan.index') }}">Pemeriksaan PTM</x-nav-link>
                </li>
              </ul>
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
                  stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </span>
            </a>
            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Laporan">
              <ul>
                <li class="my-2">
                  <x-nav-link href="/laporan" :active="request()->is('laporan')">Laporan Kegiatan</x-nav-link>
                </li>
                <li class="my-2">
                  <x-nav-link href="/laporan-bumil" :active="request()->is('laporan-bumil')">Laporan Ibu Hamil</x-nav-link>
                </li>
                <li class="my-2">
                  <x-nav-link href="/laporan-balita" :active="request()->is('laporan-balita')">Laporan Anak</x-nav-link>
                </li>
                <li class="my-2">
                  <x-nav-link href="/laporan-lansia" :active="request()->is('laporan-lansia')">Laporan Lansia</x-nav-link>
                </li>
              </ul>
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
                  stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </span>
            </a>
            <div x-show="open" class="mt-2 space-y-2 px-7" role="menu" arial-label="Pengaturan">
              <ul>
                <li class="my-2">
                  <x-nav-link route-pattern="profile" href="{{ route('profile') }}">Profile</x-nav-link>
                </li>
                <li class="my-2">
                  <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <x-nav-link href="#" :active="request()->is('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                        Sign out
                    </x-nav-link>
                </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
</header>