@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex items-center px-4 py-3 text-lg md:text-sm w-full text-bland-100 bg-primary-yellow'
            : 'flex items-center px-4 py-3 text-lg md:text-sm w-full transition duration-300 ease-in-out hover:bg-primary-yellow hover:text-bland-200 text-bland-300';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $icon }}
    <span>{{ $slot }}</span>
</a>