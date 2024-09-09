<div class="hidden lg:block fixed z-20 inset-0 right-auto w-[18.5rem] pb-10 pl-6 pr-6 overflow-y-auto shadow-md bg-white">
  <!-- Untuk admin -->
  @if (auth()->user()->is_admin)
    <nav id="nav" class="lg:text-sm lg:leading-6 relative">
      <div class="sticky top-0 -ml-0.5 pointer-events-none items-center bg-white">
        <p class="py-6 lg:flex font-semibold text-lg text-center text-stone-700">Sistem Informasi Posyandu</p>
        <div class="border-b border-gray-300"></div>
      </div>
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
  </nav>

  <!-- Untuk pengguna -->
  @else
  <nav id="nav" class="lg:text-sm lg:leading-6 relative">
    <div class="sticky top-0 -ml-0.5 pointer-events-none items-center bg-white">
      <p class="py-6 lg:flex font-semibold text-lg text-center text-stone-700">Sistem Informasi Posyandu</p>
      <div class="border-b border-gray-300"></div>
    </div>
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
  </nav>
  @endif
</div>