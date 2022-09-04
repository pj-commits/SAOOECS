@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 text-lg md:text-sm w-full text-gray-100 bg-zinc-400'
            : 'flex items-center px-4 py-3 text-lg md:text-sm w-full transition duration-300 ease-in-out hover:bg-zinc-400 hover:text-gray-100 text-gray-300';  
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $icon }}
    <span>{{ $slot }}</span>
    <span class="ml-auto"> {{ $arrow }} </span>
    
</button>