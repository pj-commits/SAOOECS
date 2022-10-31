<div x-show="pageCount() > 1" class="flex justify-left">
                       
    {{-- Previous Page --}}

    {{-- User is on First Page --}}
    <template x-if="isFirstPage()">
        <span aria-disabled="true">
            <span class="relative inline-flex items-center mx-1 px-2 py-2 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 rounded-l-md leading-5 cursor-not-allowed" aria-hidden="true">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
        </span>
    </template>

    {{-- User is not on First Page --}}
    <template x-if="!isFirstPage()">
        <a x-on:click="prevPage" rel="prev" class="relative inline-flex items-center mx-1 px-2 py-2 text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 rounded-l-md leading-5 cursor-pointer hover:bg-white">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            Previous
        </a>
    </template>
    
    {{-- Pages --}}
    <template x-for="(page,index) in pages()" :key="index">
        <span aria-current="page">
            <a x-on:click="viewPage(index)"
                    class="relative inline-flex items-center mx-1 px-4 py-2 -ml-px text-sm font-medium text-gray-500 border border-gray-300 leading-5 hover:bg-white"
                    :class="{'bg-white text-gray-500 cursor-default' : index === pageNumber,
                             'bg-gray-100 cursor-pointer' : index != pageNumber }">
                <span x-text="index+1"></span>
            </a>
        </span>
    </template>

    {{-- Next Page --}}

    {{-- User is not on Last Page --}}
    <template x-if="!isLastPage()">
        <a x-on:click="nextPage" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 rounded-r-md leading-5 cursor-pointer hover:bg-white">
            Next
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        </a>
    </template>

    {{-- User is on Last Page --}}
    <template x-if="isLastPage()">
        <span aria-disabled="true">
            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-gray-100 border border-gray-300 cursor-not-allowed rounded-r-md leading-5" aria-hidden="true">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </span>
        </span>
    </template>

</div>