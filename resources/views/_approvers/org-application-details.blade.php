<x-app-layout>
    <div x-data="{deny: false, modal:false}" class="pt-24"> 
        <div x-data="{approve: false, modal:false}" class="max-w-screen mx-auto px-4 lg:px-8">
            <div class="bg-white mt-4 h-auto w-full rounded-sm shadow-sm px-6 py-4">

                {{-- Row #1 --}}
                <div class="grid grid-flow-row auto-rows-max gap-6 mt-4 md:grid-cols-2">
                    <p class="text-bland-600 font-bold">Proposed Organization Name: <span class="font-normal"> {{ $applicationData->org_name}}</span></p>
                    <p class="text-bland-600 font-bold md:col-start-4">Date Submitted: <span class="font-normal">{{ date('M d, Y', strtotime($applicationData->created_at)) }}</span></p> 
                </div>

                {{-- Row #2 --}}
                <div class="grid grid-flow-row auto-rows-max gap-6 mt-4 md:grid-cols-2">
                    <p class="text-bland-600 font-bold">Proposed By: <span class="font-normal"> {{ $applicationData->getUser()->first()->first_name }} {{ $applicationData->getUser()->first()->last_name }}</span></p>
                </div>

                <hr class="my-8">

                {{-- Row #3 --}}
                <div class="flex my-4 space-x-2">
                    <p class="text-bland-600 font-bold">Description: </p>
                    <p> {{ $applicationData->description }} </p>
                </div>

                <hr class="my-8"> 

                {{-- Row #4 --}}
                <div class="flex my-4 space-x-2">
                    <p class="text-bland-600 font-bold">Purpose: </p>
                    <p> {{ $applicationData->purpose }} </p>
                </div>

                <hr class="my-8"> 

                <div class="mt-8 mb-2">

                    <x-button  bg="bg-semantic-success" hover="hover:bg-green-600" type="button" class="px-8" @click="approve = true, modal = true">
                        {{ __('Approve') }}
                    </x-button>

                    <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" type="button" class="px-8" @click="deny = true, modal = true">
                        {{ __('Deny') }}
                    </x-button>
                   
                </div>

            </div>

            {{-- Approve Modal --}}
            <x-modal name="approve">
                <p class="text-sm text-bland-500 mt-4">Once you click confirm the organization will be automatically created. Do you want to continue?
                </p>

                <div class="flex justify-end space-x-2 mt-4">
                    <form action="{{ route('org-application.approve', ['id' => $applicationData->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-button bg="bg-semantic-success" hover="hover:bg-green-600" type="submit" >
                            {{ __('Confirm') }}
                            
                        </x-button>
                    </form>
                    <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="approve = false, modal = false" >
                        {{ __('Cancel') }}
                    </x-button>
                </div>
            </x-modal>

            
            {{-- Deny Modal --}}
            <x-modal name="deny">
                <p class="text-sm text-bland-500 mt-4">Are you sure you want to deny this organization application?
                </p>

                <div class="flex justify-end space-x-2 mt-4">
                    <form action="{{ route('org-application.deny', ['id' => $applicationData->id ]) }}"  method="POST">
                        @csrf
                        @method('PUT')
                        <x-button bg="bg-semantic-success" hover="hover:bg-green-600" type="submit" >
                            {{ __('Confirm') }}
                            
                        </x-button>
                    </form>
                    <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="deny = false, modal = false" >
                        {{ __('Cancel') }}
                    </x-button>
                </div>
            </x-modal>

        </div>
    </div>
</x-app-layout>