@props(['name', 'count'])

<div class="w-72 bg-white p-4 shadow-sm rounded-sm">
    <div class="flex items-center space-x-4">
      <div class="bg-gray-100 p-4 rounded-full ">
        <x-svg width="w-7" height="h-7" color="fill-gray-600" marginRight="mr-0">
            {{ $slot }}
        </x-svg>
      </div>
      <div class="text-center leading-tight">
        <p class="text-sm text-gray-600">{{ $name }}</p>
          {{ $count }}
      </div>
    </div>
</div>