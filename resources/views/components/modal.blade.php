@props(['name', 'width' => 'w-96'])


<div x-cloak x-show="{{ $name }}" class="z-50 fixed top-0 left-0 w-screen h-screen bg-gray-900 bg-opacity-30">
    <div 
        x-cloak
        x-init="setTimeout( () => modal = false, 200)" 
        x-show="modal"     
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-6"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 translate-y-12"
        class="flex justify-center items-center w-full h-full p-4">
        <div class="relative bg-white py-8 px-8 {{ $width }} rounded-lg shadow-sm" @click.outside="{{ $name }} = false, modal = false" @scroll.window="{{ $name }} = false, modal = false">
            <div class="absolute top-5 right-7 cursor-pointer" @click="{{ $name }} = false, modal = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-bland-400 hover:fill-bland-600" fill="currentColor" height="24" width="24">
                    <path d="M6.4 19 5 17.6l5.6-5.6L5 6.4 6.4 5l5.6 5.6L17.6 5 19 6.4 13.4 12l5.6 5.6-1.4 1.4-5.6-5.6Z"/>
                </svg>
            </div>

           {{ $slot }}
            
        </div>
    </div>
</div>