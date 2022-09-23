@if(session()->has('edit'))
<div x-cloak
     x-data="{alert: false }" 
     x-show="alert"     
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 translate-y-6"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-1000"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0 translate-y-6"
     x-init="setTimeout( () => alert = true, 500), setTimeout( () => alert = false, 7000)" 
     class="absolute w-auto h-auto bg-semantic-info border-t-4 border-primary-blue rounded-b text-teal-900 top-20 right-5 shadow-md" role="alert">
    <div class="flex">
      <div class="flex justify-center items-center py-3 px-6">
        <x-svg width="w-6" height="w-6" color="fill-bland-100">
            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
        </x-svg>
      <div>
        <p class="font-bold text-bland-100 tracking-wider">Action Info</p>
        <p class="text-sm text-bland-200">{{ session('edit') }}</p>
      </div>
    </div>
  </div>
</div>
@endif
@if(session()->has('add'))
<div x-cloak
     x-data="{alert: false }" 
     x-show="alert"     
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 translate-y-6"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-1000"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0 translate-y-6"
     x-init="setTimeout( () => alert = true, 500), setTimeout( () => alert = false, 7000)" 
     class="absolute w-auto h-auto bg-green-600 border-t-4 border-semantic-success rounded-b text-teal-900 top-20 right-5 shadow-md" role="alert">
    <div class="flex">
      <div class="flex justify-center items-center py-3 px-6">
        <x-svg width="w-6" height="w-6" color="fill-bland-100">
            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
        </x-svg>
      <div>
        <p class="font-bold text-bland-100 tracking-wider">Action Info</p>
        <p class="text-sm text-bland-200">{{ session('add') }}</p>
      </div>
    </div>
  </div>
</div>
@endif
@if(session()->has('remove'))
<div x-cloak
     x-data="{alert: false }" 
     x-show="alert"     
     x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 translate-y-6"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-1000"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0 translate-y-6"
     x-init="setTimeout( () => alert = true, 500), setTimeout( () => alert = false, 7000)" 
     class="absolute w-auto h-auto bg-rose-600 border-t-4 border-semantic-danger rounded-b text-teal-900 top-20 right-5 shadow-md" role="alert">
    <div class="flex">
      <div class="flex justify-center items-center py-3 px-6">
        <x-svg width="w-6" height="w-6" color="fill-bland-100">
            <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/>
        </x-svg>
      <div>
        <p class="font-bold text-bland-100 tracking-wider">Action Info</p>
        <p class="text-sm text-bland-200">{{ session('remove') }}</p>
      </div>
    </div>
  </div>
</div>
@endif
