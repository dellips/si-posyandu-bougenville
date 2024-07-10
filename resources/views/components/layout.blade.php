<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <title>Dashboard</title>
</head>
<body class="h-full bg-white">
  <x-navbar></x-navbar>
    <div class="lg:pl-[18.5rem]">
      <div class="max-w-3x1 mx-auto pt-6 xl:max-w-none xl:ml-0 ">
        <x-header>{{ $title }}</x-header>
        <main>
          <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            {{$slot}}
          </div>
        </main>
      </div>
    </div>
</body>
</html>