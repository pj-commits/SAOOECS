<x-app-layout>
    <!--Roles -->
    <div x-data="{ modal : false }">
        <!-- Org Name -->
        <div class="pt-12">
            <div class="max-w-screen mx-auto px-4 lg:px-8">
                <h1>Organization:</h1>
                <div class="bg-white mt-4 h-auto w-full rounded-sm shadow-sm">
                    <h1 class="px-6 py-4">Student Organization Name</h1>
                </div>
            </div>
        </div>

        <!-- table -->
        <div class="mt-8">
            <div class="max-w-screen mx-auto px-4 lg:px-8">
                <div class="flex justify-between">
                    <h1 class="text-lg">Members (69)</h1>
                    <div>
                        <!-- Modal Button -->
                        <x-button class="bg-sky-800" @click="modal = true">
                            {{ __('Add Member') }}
                        </x-button>
                    </div>
                </div>
                <div class="bg-white mt-4 h-auto w-full shadow-sm">
                    <div class="overflow-x-auto rounded-sm">
                        <table class="table-auto w-full border-collapse text-left">
                            <thead class="border-b bg-yellow-500">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">Name</th>
                                    <th scope="col" class="text-sm font-medium text-white px-6 py-4">Position</th>
                                    <th scope="col" class="text-sm text-center font-medium text-white px-6 py-4">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach(roles as role) --}}
                                <tr class="bg-white border hover:bg-gray-100">
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">Marc Kenneth Ricahuerta</td>
                                    <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">President</td>
                                    <td class="text-sm text-gray-900 text-center font-light px-6 py-4 whitespace-nowrap">
                                        <x-button class="bg-rose-700 ">
                                            {{ __('Remove') }}
                                        </x-button>
                                    </td>
                                </tr>
                                {{-- @endforeach --}}
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div x-cloak x-show="modal" class="z-30 fixed top-0 left-0 w-screen h-screen bg-gray-900 bg-opacity-30">
            <div class="flex justify-center items-center w-full h-full p-4">
                <div class="relative bg-white py-12 px-8 w-96 rounded-lg shadow-sm" @click.outside="modal = false">
                    <div class="absolute top-5 right-7 cursor-pointer" @click="modal = false">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24">
                            <path d="M6.4 19 5 17.6l5.6-5.6L5 6.4 6.4 5l5.6 5.6L17.6 5 19 6.4 13.4 12l5.6 5.6-1.4 1.4-5.6-5.6Z"/>
                        </svg>
                    </div>

                    <form action="">
                        @csrf
                        <!-- Email Address -->
                        <div>
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                        </div>

                        <!-- Roles -->
                        <div class="mt-6">
                            <x-label for="role_id" :value="__('Role')" />

                            <x-select name="role_id" aria-label="Default select example">
                                <x-slot name="slot">
                                    <option selected>Choose Role</option>
                                    <option value="president">President</option>
                                    <option value="secretary">Secretary</option>
                                    <option value="member">Member</option>
                                </x-slot>
                            </x-select>
                        </div>

                        <!-- Add Member Button -->
                        <div class="flex justify-end mt-12">
                            <x-button class="bg-green-700">
                                {{ __('Add Member') }}
                            </x-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

            
