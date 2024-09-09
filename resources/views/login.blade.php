<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('path/to/selectize.css') }}">
    <script src="{{ asset('path/to/selectize.min.js') }}"></script>
    <title>Login</title>
</head>
<body class="h-full">
  <section class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-500 to-fuchsia-400">
    <div class="flex items-center justify-center min-h-screen py-10">
      <!-- img section -->
      <div class="sm:mx-auto sm:w-full sm:max-w-sm p-5 m-3 py-11 md:block hidden rounded-l-lg shadow-md bg-white text-center">
        <div class="flex items-center space-x-4 pb-10">
          <img
            class="mask h-10 w-10"
            src="/img/logo.png"
            alt="Logo Posyandu Bougenville"
          />
          <img
            class="mask h-8 w-13"
            src="/img/Logo-Kementerian-Kesehatan-RI_01.png"
            alt="Logo Kementerian Kesehatan"
          />
          <img
            class="mask h-8 w-13"
            src="/img/logo-kota-bandung.png"
            alt="Logo Kota Bandung"
          />
        </div>        
        <img class="mx-auto w-auto" src="/img/6911014.jpg" alt="Posyandu">
        <a href="https://www.freepik.com/free-vector/pediatrician-concept-illustration_24237740.htm" class="text-sm text-stone-300">Image by storyset on Freepik</a>
      </div>

      <!-- form section -->
      <div class="sm:mx-auto sm:w-full sm:max-w-sm p-10 m-5 py-11 rounded-r-lg shadow-lg bg-white">
        <h2 class="m-1 p-2 text-left text-2xl font-bold leading-9 tracking-tight text-stone-900">Sistem Informasi Posyandu Bougenville</h2>
        <!-- Alert Error -->
        <div class="m-1 p-2 pb-20 ">
          @if ($errors->any())
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded absolute" role="alert">
            <strong class="font-bold">Terdapat kesalahan!</strong>
            <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
          </div>
          @endif
        </div>
        
        <form class="space-y-6 text-stone-700" action="{{ route('login') }}" method="POST">
          @csrf
          <!-- field username -->
          <div>
            <label for="username" class="label-text text-stone-700">Username</label>
            <label class="input input-bordered input-primary flex items-center gap-2 bg-white">
              <svg class="h-4 w-5 text-stone-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>              
              <input id="username" name="username" type="text" class="grow" placeholder="Masukan Username" required />
            </label>
          </div>
          <!-- field password -->
          <div>
            <label for="password" class="label-text text-stone-700">Password</label>
            <label class="input input-bordered input-primary flex items-center gap-2 bg-white relative">
              <svg class="h-4 w-4 text-stone-600"  fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
              </svg>              
              <input id="password" name="password" type="password" placeholder="Masukan Password" class="grow" required />
            </label>
          </div>
          <div>
            <button type="submit" class="btn btn-primary w-full text-white">Login</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>