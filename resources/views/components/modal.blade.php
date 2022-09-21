@props(['name'])


<div x-cloak x-show="{{ $name }}" class="z-30 fixed top-0 left-0 w-screen h-screen bg-gray-900 bg-opacity-30">
    <div class="flex justify-center items-center w-full h-full p-4">
        <div class="relative bg-white py-12 px-8 w-96 rounded-lg shadow-sm" @click.outside="{{ $name }} = false">
            <div class="absolute top-5 right-7 cursor-pointer" @click="{{ $name }} = false">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-bland-400 hover:fill-bland-600" fill="currentColor" height="24" width="24">
                    <path d="M6.4 19 5 17.6l5.6-5.6L5 6.4 6.4 5l5.6 5.6L17.6 5 19 6.4 13.4 12l5.6 5.6-1.4 1.4-5.6-5.6Z"/>
                </svg>
            </div>

           {{ $slot }}
            
        </div>
    </div>
</div>