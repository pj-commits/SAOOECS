@props(['color' => 'bland-200', 'width' => '5', 'height' => '5'])

<svg xmlns="http://www.w3.org/2000/svg" class="w-{{ $width }} h-{{ $height }} mr-2 fill-{{ $color }}" fill="currentColor"  viewBox="0 0 24 24">
    {{ $slot }}
</svg>