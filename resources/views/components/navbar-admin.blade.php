<div class="hidden lg:block fixed z-20 inset-0 right-auto w-[18.5rem] pb-10 pl-6 pr-6 overflow-y-auto shadow-md bg-white">
    <nav id="nav" class="lg:text-sm lg:leading-6 relative">
      <div class="sticky top-0 -ml-0.5 pointer-events-none items-center bg-white">
        <p class="py-6 lg:flex font-semibold text-lg text-center">Sistem Informasi Posyandu</p>
        <div class="border-b border-gray-300"></div>
      </div>
      <ul class="mx-2">
        <li class="mt-6 lg:mt-3">
        <x-nav-link href="/admin" :active="request()->is('admin')">Dashboard</x-nav-link>
        </li>
        <li>
          <h5 class="mt-6 mb-2 lg:mt-3 font-medium">Data</h5>
          <ul class="space-y-6 lg:space-y-2">
            <li>
                <x-nav-link href="/kader-posyandu" :active="request()->is('kader-posyandu')">Kader Posyandu</x-nav-link>
            </li>
            <li>
                <x-nav-link href="/sasaran-posyandu" :active="request()->is('sasaran-posyandu')">Sasaran Posyandu</x-nav-link>
            </li>
            <li>
                <x-nav-link href="/kegiatan-pelayanan" :active="request()->is('kegiatan pelayanan')">Kegiatana dan Pelayanan</x-nav-link>
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
