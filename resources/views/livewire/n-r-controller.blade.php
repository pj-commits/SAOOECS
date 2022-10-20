<!-- Official Poster -->
<div class="w-full p-3 border-2 border-dashed hover:border-primary-blue md:w-[49%]">
                        
    <div>
        <h1 class="text-lg text-bland-600  my-2 pb-2">Official Poster</h1>
        <div>

            <!-- Attachment -->
            <div class="mt-4">
                
                <x-file-attachment 
                    :file="$attachment"
                    wire:model="attachment"
                />
        
                <x-input-error for="attachment" class="mt-2" />
            </div>
        
            {{-- <x-button class="mt-5" wire:click.prevent="save" type="button" wire:loading.attr="disabled"
                wire:loading.class="cursor-not-allowed"
            >
                Save
            </x-button> --}}
        </div>
        
    </div>

</div>

<!-- Event Images -->
<div class="w-full p-3 border-2 border-dashed hover:border-primary-blue md:w-[49%]">

    <div>
        <h1 class="text-lg text-bland-600 my-2">Event Images</h1>
        <div>
            <!-- Multiple Attachments -->
            <div class="mt-4">
        
                <x-file-attachment 
                    :file="$attachments"
                    wire:model="attachments"
                    multiple
                />
        
                <x-input-error for="attachments" class="mt-2" />
            </div>
        
           
        </div>
        
    </div>
    {{-- <x-button class="mt-5" wire:click.prevent="save" type="button" wire:loading.attr="disabled"
    wire:loading.class="cursor-not-allowed"
>
    Save
</x-button> --}}

</div>