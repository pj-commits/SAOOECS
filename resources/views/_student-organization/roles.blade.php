<x-app-layout>
    <!--Roles -->
    @if($invite === true)
    <div x-data="{ addMember : true }">
    @else
    <div x-data="{ addMember : false }">
    @endif
        @if(!empty($selected))
        <div x-data="{ editMember : true }">
        @else
        <div x-data="{ editMember : false }">
        @endif
            <div x-data="{ removeMember : false }">
                <!-- Org Name -->
                <div class="pt-12">
                    <div class="max-w-screen mx-auto px-4 lg:px-8">
                        <h1 class="text-lg">Organization:</h1>
                        <div class="bg-white mt-4 h-auto w-full rounded-sm shadow-sm">
                            <h1 class="text-md px-6 py-4">{{$currOrg->orgName}}</h1>
                        </div>
                    </div>
                </div>
                

                <!-- table -->
                <div class="mt-8">
                    <div class="max-w-screen mx-auto px-4 lg:px-8">
                        <div class="flex justify-between">
                            <h1 class="text-lg">Members ({{$orgMembers->count()}})</h1>
                            <div>
                                {{-- Add Member Modal Button --}}
                                <x-button class="bg-primary-blue hover:bg-blue-800" onclick="window.location='{{ route('roles.invite') }}'">
                                    {{ __('Add Member') }}
                                </x-button>
                            </div>
                        </div>

                        <x-table.main>
                            {{-- Table Head--}}
                            <x-table.head>
                                {{-- Insert Table Head Columns Here --}}
                                <x-table.head-col>Name</x-table.head-col>
                                <x-table.head-col>Position</x-table.head-col>
                                <x-table.head-col>Role</x-table.head-col>
                                <x-table.head-col class="text-center">Action</x-table.head-col>
                                {{-- Table Head Columns Ends Here --}}
                            </x-table.head>
                            {{-- Table Head Body --}}
                            @foreach ($orgMembers as $member)
                            <x-table.body>
                                {{-- Insert Table Body Columns Here --}}
                                <x-table.body-col>{{$member->firstName}} {{$member->lastName}}</x-table.body-col>
                                @foreach ($member->studentOrg as $pos)
                                <x-table.body-col>{{$pos->pivot->position}} </x-table.body-col>
                                @endforeach

                                @foreach($member->role as $pos)
                                <x-table.body-col>{{$pos->display_name}}</x-table.body-col>
                                @endforeach
                                <x-table.body-col class="flex justify-center space-x-5">
                                    <x-button class="bg-info hover:bg-blue-400" onclick="window.location='{{ route('roles.edit', $member) }}'" >
                                        {{ __('Edit') }}
                                    </x-button>
                                    <x-button class="bg-danger hover:bg-rose-600" @click="removeMember = true">
                                        {{ __('Remove') }}
                                    </x-button>
                                </x-table.body-col>
                                {{-- Table Body Columns Ends Here --}}
                            </x-table.body>
                            @endforeach
                            
                        </x-table.main>
                    </div>
                </div>

                {{-- Modal for add member --}}
                <x-modal name="addMember">
                    <form action="{{ route('roles.store') }}" method="POST">
                        @csrf
                        <!-- Email Address -->
                        <div>
                            <x-label for="email" :value="__('Email')" />
    
                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
    
                        <!-- Position -->
                        <div class="mt-3">
                            <x-label for="position" :value="__('Posiiton')" />
    
                            <x-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')" required autofocus />
                            @error('position')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
    
                        <!-- Roles -->
                        <div class="mt-3">
                            <x-label for="role_id" :value="__('Role')" />
    
                            <x-select name="role_id" aria-label="Default select example">
                                <option selected disabled>Choose Role</option>
                                <option value="6">Moderator</option>
                                <option value="7">Editor</option>
                                <option value="8">Viewer</option>
                            </x-select>
                            @error('roles')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        </div>
    
                        <!-- Add Member Button -->
                        <div class="flex justify-end mt-8">
                            <x-button class="bg-success hover:bg-green-600" type="submit">
                                {{ __('Add Member') }}
                            </x-button>
                        </div>
                    </form>
                    
                </x-modal>

                @if(!empty($selected))
                {{-- Modal for edit member --}}
                <x-modal name="editMember">
                    <form action="{{route('roles.update', $member)}}" method="POST">
                        @csrf
                        @method('PUT') 

                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{$selected->firstName}} {{$selected->lastName}}" disabled="true" autofocus />
                        </div>

                            <!-- Position -->
                   
                            <div class="mt-3">
                                <x-label for="position" :value="__('Position')" />
                             
                                <x-input id="position" class="block mt-1 w-full" type="text" name="position" :value="old('position')" required autofocus value="{{$selected->studentOrg->first()->pivot->position}}" />
                            </div>

                            <!-- Roles -->
                            <div class="mt-3">
                                <x-label for="role_id" :value="__('Role')"/>
                                {{-- @dd($selected->role->first()->id) --}}

                                <x-select name="role_id" aria-label="Default select example">
                                    <option selected disabled>Choose Role</option>
                                    <option {{$selected->role->first()->id == "6"? 'selected':''}}  value="6">Moderator</option>
                                    <option {{$selected->role->first()->id == "7"? 'selected':''}}  value="7">Editor</option>
                                    <option {{$selected->role->first()->id == "8"? 'selected':''}}  value="8">Viewer</option>
                                </x-select>
                            </div>
                       

                        <!-- Edit Member Button -->
                        <div class="flex justify-end mt-8">
                            <x-button class="bg-success hover:bg-green-600">
                                {{ __('Edit Member') }}
                            </x-button>
                        </div>
                       
                    </form>
                </x-modal> 
                @endif
                
                {{-- Remove member modal --}}
                <x-modal name="removeMember">
                    <div class="py-5 text-center">
                        Are you sure you want to remove <br> <b>{Student Name}</b> from <b>{Organization Name}</b>?
                    </div>
                    <div class="flex justify-center space-x-4 mt-5">
                        <x-button class="bg-danger hover:bg-rose-600" >
                            {{ __('Remove') }}
                        </x-button>

                        <x-button class="bg-success hover:bg-green-600" @click="removeMember = false">
                                {{ __('Cancel') }}
                        </x-button>
                    </div>
                </x-modal>

            </div>
        </div>
    </div>
</x-app-layout>

            