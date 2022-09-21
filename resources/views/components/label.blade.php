@props(['value'])

{{-- <label {{ $attributes->merge(['class' => 'block pb-1 font-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
</label> --}}

<label {{ $attributes->merge(['class' => 'font-bold text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
