<x-app-layout>    

    <!-- Error Mesage -->
    <x-alert-message/>   

    <div class="pt-24">
        <div class="px-4 lg:px-8">
            <h1 class="text-xl"><span class="text-primary-blue hover:text-semantic-info"> <a href="{{ route('organization.index') }}"> Organizations </a></span>/ 
                <span class="text-primary-blue hover:text-semantic-info"> <a href="{{ route('organization.show', ['id' => $currOrg->id]) }}"> {{ $currOrg->org_name }}</a></span> / Add Member</h1>
            <div class="flex">
                <div class="basis-full h-auto bg-white mt-4 rounded-sm shadow-sm p-6 lg:basis-[50%] xl:basis-[40%]">
                    <form action="{{ route('organization.store', ['id' => $currOrg->id]) }}" method="POST">
                        @csrf
                        <div class="space-y-6">
                            <!-- Email Address -->
                            <div>
                                <x-label for="email" :value="__('Email')" />
        
                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
        
                            <!-- Position -->
                            <div class="mt-3">
                                <x-label for="position" :value="__('Position')" />
        
                                <x-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')" required autofocus />
                                @error('position')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
        
                            <!-- Roles -->
                            <div class="mt-3">
                                <x-label for="role" :value="__('Role')" />
        
                                <x-select name="role" aria-label="Default select example">
                                    <option value="" selected disabled>--choose role--</option>
                                    <option value="Moderator">Moderator</option>
                                    <option value="Editor">Editor</option>
                                    <option value="Viewer">Viewer</option>
                                </x-select>
                                @error('role')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
        
                            <!-- Add Member Button -->
                            <div class="flex justify-end pt-8">
                                <x-button bg="bg-semantic-success" hover="hover:bg-green-600" type="submit">
                                    {{ __('Add Member') }}
                                </x-button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>

            