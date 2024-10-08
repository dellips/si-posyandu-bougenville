<div class="flex justify-end">
  <form action="{{ route('search') }}" method="GET" class="relative">
    <input type="text" name="q" placeholder="Search..." class="w-32 pl-5 pr-4 rounded-md form-input sm:w-64 focus-visible:outline-purple-500 bg-transparent">
    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
      <svg class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="none">
        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" 
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
      </svg>
    </button>
  </form>
</div>
  