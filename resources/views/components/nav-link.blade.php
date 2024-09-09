@aware(['routePattern'])

@php
$isActive = request()->routeIs($routePattern);
@endphp

<a {{ $attributes->merge([
    'class' => $isActive ? 'flex items-center border-1 py-2 px-4 -ml-px text-white border-transparent bg-violet-500 rounded-lg shadow-md' : 'p-4 -ml-px border-transparent text-stone-700 hover:text-violet-500 ',
    'aria-current' => $isActive ? 'page' : false
]) }}>
    {{ $slot }}
</a>