<x-app-layout>
    <div x-data="{cancelForm: false, modal:true} ">
        <div class="pt-16"> 

            {{-- If there's no pending form --}} 
            <div class="max-w-screen mx-auto px-4 lg:px-8">
                <div class="mt-4 h-auto w-full rounded-sm px-6 py-4">
                    <div class="flex flex-col justify-center items-center py-16 px-2 md:px-8">
                        <img class="w-auto h-auto sm:h-96 object-cover" src="{{ asset('assets/img/stud-org-no-pending-forms.png')}}" alt="No Forms Pending"/>
                        <div class="text-center space-y-3 mt-3">
                            <h1 class="text-2xl text-bland-500 font-bold tracking-wider">No Pending Form! 📣 </h1>
                            <p class="text-sm text-bland-400">Looks like nothing to see here. </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- If there's pending form --}} 
            {{-- <div class="max-w-screen mx-auto px-4 lg:px-8">
                <div class="bg-white mt-4 h-auto w-full rounded-sm shadow-sm px-6 py-4">

                    <p class="my-4">Your Pending Forms:</p>
                    <hr>

                    <!-- Accordion -->
                    <div class="">
                        <div x-data="{ open: true}">
                            <div class="h-auto grid grid-flow-row auto-rows-max mt-4 border-2 border-bland-100 rounded-t-md px-8 py-4 shadow-md cursor-pointer
                            lg:grid-cols-3" @click="open = !open">
                                <p class="">Even Title: {HimigKantahan}</p>
                                <p class="">Current Approver: {Academic Services Head}</p>
                                <p class="lg:text-end">Status: {Pending}</p>
                            </div>
                            <!-- Accordion Body -->
                            <div x-cloak x-transition 
                                x-show="open" 
                                class="bg-white border-2 border-t-0 border-bland-100 px-8">
                                <!-- Accordion Body Top -->
                                <div class="pt-8 pb-2 space-y-2">
                                <div class="grid grid-cols-2">
                                    <p>Date Submitted:</p>
                                    <p>Submitted By:</p>
                                </div>
                                <div class="grid grid-cols-2">
                                    <p>Form Type:</p>
                                    <p>Control Number:</p>
                                </div>
                                </div>

                                <hr>
                                <!-- Accordion Body Bottom -->
                                <!-- cancelForm Button && Push Notes -->
                                <div class="flex justify-end space-x-2 my-4">
                                    <x-button>
                                        {{__('Push Note')}}
                                    </x-button>
                                    <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="cancelForm = true,  modal= true">
                                        {{__('Cancel')}}
                                    </x-button>
                                </div>
                                <div class="flex md:justify-center mt-8 mb-16">
                                    <div class="relative">
                                        <div class="h-96 bg-gray-200 w-1 mb-6">
                                            <div class="bg-primary-yellow w-1" style="height: 25%"></div>
                                        </div> --}}
                                        {{-- Adviser --}}
                                        {{-- <div class="flex absolute w-64 top-0 -left-2 space-x-2">
                                            <div class="w-5 h-5  bg-bland-200 border-4 border-bland-200 rounded-full"></div>
                                            <div class="flex flex-col flex-nowrap">
                                                <div class="font-bold ">Adviser</div>
                                                <div class="text-sm text-bland-400 font-medium">Date Approved: <br> September 20, 2022</div>
                                            </div>
                                        </div> --}}
                                        {{-- SAO Head --}}
                                        {{-- <div class="flex absolute w-64 top-32 -left-2 space-x-2">
                                            <div class="w-5 h-5  bg-bland-200 border-4 border-bland-200 rounded-full"></div>
                                            <div class="flex flex-col flex-nowrap">
                                                <div class="font-bold ">Sao Head</div>
                                                <div class="text-sm text-bland-400 font-medium">Date Approved: <br> September 20, 2022</div>
                                            </div>
                                        </div> --}}
                                        {{-- AcadServ Head --}}
                                        {{-- <div class="flex absolute w-64 top-64 -left-2 space-x-2">
                                            <div class="w-5 h-5  bg-bland-200 border-4 border-bland-200 rounded-full"></div>
                                            <div class="flex flex-col flex-nowrap">
                                                <div class="font-bold ">Academic Services Head</div>
                                                <div class="text-sm text-bland-400 font-medium">Date Approved: <br> September 20, 2022</div>
                                            </div>
                                        </div> --}}
                                        {{-- Finance Head --}}
                                        {{-- <div class="flex absolute w-64 top-96 -left-2 space-x-2">
                                            <div class="w-5 h-5  bg-bland-200 border-4 border-bland-200 rounded-full"></div>
                                            <div class="flex flex-col flex-nowrap">
                                                <div class="font-bold ">Finance Head</div>
                                                <div class="text-sm text-bland-400 font-medium">Date Approved: <br> September 20, 2022</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> --}}


        {{-- Cancel form modal --}}
        {{-- <x-modal name="cancelForm">
            <div class="py-5 text-center">
                <p>Are you sure you wan to cancel {this form}?</p>
            </div>
            
            <div class="flex justify-center space-x-4 mt-5">
                <form action="" method="POST">
                    @csrf           
                    <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" type="submit" >
                        {{ __('Yes') }}
                        
                    </x-button>
                </form>

                <x-button bg="bg-semantic-success" hover="hover:bg-green-600" @click="cancelForm = false, modal=false" >
                        {{ __('No') }}
                </x-button>
            </div>
        </x-modal> --}}
    </div>
</x-app-layout>




