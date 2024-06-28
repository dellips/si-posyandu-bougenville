<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Login</title>
</head>
<body class="h-full">
  <section class="min-h-screen flex items-center justify-center bg-gradient-to-r from-green-400 to-cyan-300">
    <div class="flex items-center justify-center min-h-screen">
      <div class="sm:mx-auto sm:w-full sm:max-w-sm md:block hidden m-5 py-11 px-5 rounded-l-lg shadow-md bg-white">
       <img class="mx-auto h-90 w-auto" src="https://img.freepik.com/vecteurs-libre/illustration-concept-pediatre_114360-8805.jpg?t=st=1718896166~exp=1718899766~hmac=0e02d02cf466578a551a14f23134ca320ee6faff80ec50057e87a139bfc34703&w=740" alt="Posyandu">
      </div>

      <div class="sm:mx-auto sm:w-full sm:max-w-sm p-10 m-5 rounded-r-lg shadow-md bg-white">
        <h2 class="mt-10 text-left text-2xl font-bold leading-9 tracking-tight text-gray-900 pb-5">Sistem Informasi Posyandu Bougenville</h2>
        <form class="space-y-6" action="#" method="POST">
          <div>
            <label for="uname" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
            <div class="mt-2">
              <input id="uname" name="uname" type="text" placeholder="Masukan Username" autocomplete="current-uname" required class="block w-full rounded-lg border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 pl-2 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            </div>
            <div class="mt-2">
              <input id="password" name="password" type="password" placeholder="Masukan Password" autocomplete="current-password" required class="block w-full rounded-lg border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 pl-2 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
            </div>
          </div>

          <div>
            <button type="submit" class="flex w-full justify-center rounded-lg bg-green-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-green-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
          </div>
        </form>
      </div>
    </div>
  </section>
</body>
</html>