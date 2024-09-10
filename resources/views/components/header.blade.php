
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
                <x-nav-link route-pattern="sasaran.*" href="{{ route('sasaran.index') }}">Sasaran Posyandu</x-nav-link>
              </li>
              <li class="my-2">
                <x-nav-link route-pattern="kegiatan.*" href="{{ route('kegiatan.index') }}">Kegiatan</x-nav-link>
              </li>
            </ul>
          </li>
          <li class="my-4">
            <h5 class="mt-6 mb-2 lg:mt-3 font-medium text-primary">Kegiatan</h5>
            <ul class="space-y-6 lg:space-y-2">
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
                <x-nav-link route-pattern="sasaran.*" href="{{ route('sasaran.index') }}">Sasaran Posyandu</x-nav-link>
              </li>
              <li class="my-2">
                <x-nav-link route-pattern="kegiatan.*" href="{{ route('kegiatan.index') }}">Kegiatan</x-nav-link>
              </li>
            </ul>
          </li>
          <li class="my-4">
            <h5 class="mt-6 mb-2 lg:mt-3 font-medium text-primary">Kegiatan</h5>
            <ul class="space-y-6 lg:space-y-2">
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
            </ul>
          </li>
          <li class="my-4">
            <h5 class="mt-6 mb-2 lg:mt-3 font-medium text-primary">Pengaturan</h5>
            <ul class="space-y-6 lg:space-y-2">
              <li class="my-2">
                <x-nav-link route-pattern="profile" href="{{ route('profile') }}">Profil</x-nav-link>
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
  @endif
</header>