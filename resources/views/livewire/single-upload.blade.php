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
