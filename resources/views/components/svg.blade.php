@props(['color' => 'fill-bland-200', 'width' => 'w-5', 'height' => 'w-5'])

<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"  viewBox="0 0 24 24" 
    {{ $attributes->class([ 'mr-2', $width, $height, $color ]) }} >
        {{ $slot }}
</svg>