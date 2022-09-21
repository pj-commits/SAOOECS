<x-app-layout>
    <!--Roles -->
    <div x-data="{ addMember : false }">
        <div x-data="{ editMember : false }">
            <div x-data="{ removeMember : false }">
                <!-- Org Name -->
                <div class="pt-12">
                    <div class="max-w-screen mx-auto px-4 lg:px-8">
                        <h1 class="text-lg">Organization:</h1>
                        <div class="bg-white mt-4 h-auto w-full border-b border-gray-200 rounded-sm shadow-sm">
                            <h1 class="text-md px-6 py-4">Student Organization Name</h1>
                        </div>
                    </div>
                </div>

                <!-- table -->
                <div class="mt-8">
                    <div class="max-w-screen mx-auto px-4 lg:px-8">
                        <div class="flex justify-between">
                            <h1 class="text-lg">Members (69)</h1>
                            <div>
                                {{-- Add Member Modal Button --}}
                                <x-button @click="addMember = true">
                                    {{ __('Add Member') }}
                                </x-button>
                            </div>
                        </div>

                        <x-table.main>
                            {{-- Table Head--}}
                            <x-table.head>
                                {{-- Insert Table Head Columns Here --}}
                                <x-table.head-col class="pl-6">Name</x-table.head-col>
                                <x-table.head-col class="pl-6">Position</x-table.head-col>
                                <x-table.head-col class="pl-6">Role</x-table.head-col>
                                <x-table.head-col class="text-center">Action</x-table.head-col>
                                {{-- Table Head Columns Ends Here --}}
                            </x-table.head>
                            {{-- Table Head Body --}}
                            <x-table.body>
                                {{-- Insert Table Body Columns Here --}}
                                <x-table.body-col class="pl-6">Marc Kenneth Ricahuerta</x-table.body-col>
                                <x-table.body-col class="pl-6">President </x-table.body-col>
                                <x-table.body-col class="pl-6">Moderator </x-table.body-col>
                                <x-table.body-col class="flex justify-center space-x-5 pr-3 pl-3 md:pr-0 md:pl-3">
                                    <x-button bg="bg-semantic-info" hover="hover:bg-blue-400" @click="editMember = true">
                                        {{ __('Edit') }}
                                    </x-button>
                                    <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="removeMember = true">
                                        {{ __('Remove') }}
                                    </x-button>
                                </x-table.body-col>
                                {{-- Table Body Columns Ends Here --}}
                            </x-table.body>
                            
                        </x-table.main>
                    </div>
                </div>

                {{-- Modal for add member --}}
                <x-modal name="addMember">
                    <form action="">
                        @csrf
                        <!-- Email Address -->
                        <div>
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        </div>

                        <!-- Position -->
                        <div class="mt-3">
                            <x-label for="position" :value="__('Posiiton')" />

                            <x-input id="email" class="block mt-1 w-full" type="text" name="position" :value="old('position')" required autofocus />
                        </div>

                        <!-- Roles -->
                        <div class="mt-3">
                            <x-label for="roles" :value="__('Role')" />

                            <x-select name="roles" aria-label="Default select example">
                                <option selected disabled>--select role--</option>
                                <option value="moderator">Moderator</option>
                                <option value="editor">Editor</option>
                                <option value="viewer">Viewer</option>
                            </x-select>
                        </div>

                        <!-- Add Member Button -->
                        <div class="flex justify-end mt-8">
                            <x-button bg="bg-semantic-success" hover="hover:bg-green-600">
                                {{ __('Add Member') }}
                            </x-button>
                        </div>
                    </form>
                </x-modal>

                {{-- Modal for edit member --}}
                <x-modal name="editMember">
                    <form action="">
                        @csrf
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{Student Name}" disabled="true" autofocus />
                        </div>

                        <!-- Position -->
                        <div class="mt-3">
                            <x-label for="position" :value="__('Posiiton')" />

                            <x-input id="email" class="block mt-1 w-full" type="text" name="position" :value="old('position')" required autofocus />
                        </div>

                        <!-- Roles -->
                        <div class="mt-3">
                            <x-label for="roles" :value="__('Role')" />

                            <x-select name="roles" aria-label="Default select example">
                                <option selected disabled>--select role--</option>
                                <option value="moderator">Moderator</option>
                                <option value="editor">Editor</option>
                                <option value="viewer">Viewer</option>
                            </x-select>
                        </div>

                        <!-- Edit Member Button -->
                        <div class="flex justify-end mt-8">
                            <x-button bg="bg-semantic-success" hover="hover:bg-green-600">
                                {{ __('Edit Member') }}
                            </x-button>
                        </div>
                    </form>
                </x-modal> 
                
                {{-- Remove member modal --}}
                <x-modal name="removeMember">
                    <div class="py-5 text-center">
                        Are you sure you want to remove <br> <b>{Student Name}</b> from <b>{Organization Name}</b>?
                    </div>
                    <div class="flex justify-center space-x-4 mt-5">
                        <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" >
                            {{ __('Remove') }}
                        </x-button>

                        <x-button bg="bg-semantic-success" hover="hover:bg-green-600" @click="removeMember = false">
                                {{ __('Cancel') }}
                        </x-button>
                    </div>
                </x-modal>

            </div>
        </div>
    </div>
</x-app-layout>

            
