@props(['orientation', 'marginRight' => 'mr-[120px]'])

@if($orientation === 'vertical')
<div class="flex md:justify-center pt-8 pb-4 mb-8">
    <div class="flex relative">
    
        <!-- Line -->
        <div class="bg-gray-200  broder-2 border-bland-200 w-1 mt-4 mb-4">
            <div class="h-full bg-primary-yellow w-1"></div>
        </div>
    
        <!-- Content -->
        <div class="flex flex-col space-y-14">
            {{ $slot }}
        </div>

    </div>

</div>
@elseif($orientation === 'horizontal')
<div class="flex justify-center my-6">
    <div class="flex flex-col relative">
    
        <!-- Line -->
        <div class="bg-gray-200  broder-2 border-bland-200 h-1 {{ $marginRight }} ml-8">
            <div class="w-full bg-primary-yellow h-1"></div>
        </div>
    
        <!-- Content -->
        <div class="flex space-x-32">
            {{ $slot }}
        </div>

    </div>

</div>

@endif
