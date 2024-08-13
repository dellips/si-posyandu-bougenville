@props(['active' => false])

<a class="{{ $active ? 'text-green-600 rounded-lg shadow-md' : 'hover:text-green-600' }} 
flex items-center border-1 py-1 pb-2 px-4 -ml-px border-transparent text-gray-700" 
    aria-current="{{ $active ? 'page' : false }}"{{ $attributes }}>{{ $slot }}</a>