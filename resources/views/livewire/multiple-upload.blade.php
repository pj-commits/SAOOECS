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

    {{-- <x-button class="mt-5" wire:click.prevent="save" type="button" wire:loading.attr="disabled"
    	wire:loading.class="cursor-not-allowed"
    >
        Save
    </x-button> --}}
   
</div>
