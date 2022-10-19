<x-app-layout>
    <div x-data="{cancelForm: false, modal:true} ">
        <div class="pt-16"> 

            {{-- If there's no pending form --}} 
            {{-- <div class="max-w-screen mx-auto px-4 lg:px-8">
                <div class="mt-4 h-auto w-full rounded-sm px-6 py-4">
                    <div class="flex flex-col justify-center items-center py-16 px-2 md:px-8">
                        <img class="w-auto h-auto sm:h-96 object-cover" src="{{ asset('assets/img/stud-org-no-pending-forms.png')}}" alt="No Forms Pending"/>
                        <div class="text-center space-y-3 mt-3">
                            <h1 class="text-2xl text-bland-500 font-bold tracking-wider">No Pending Form! 📣 </h1>
                            <p class="text-sm text-bland-400">Looks like nothing to see here. </p>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- If there's pending form --}} 
            <x-alert-message/>  
            <div class="max-w-screen mx-auto px-4 lg:px-8">
                <div class="bg-white mt-4 h-auto w-full rounded-sm shadow-sm px-6 py-4">

                    <p class="my-4">Your Pending Forms:</p>
                    <hr>

                    <!-- Accordion -->
                    @foreach($myForms as $form)
                    <div class="">
                        <div x-data="{ open: false}">
                            <div class="h-auto grid grid-flow-row auto-rows-max mt-4 border-2 border-bland-100 rounded-t-md px-8 py-4 shadow-md cursor-pointer
                            lg:grid-cols-3" @click="open = !open">
                                <p class="">Even Title: {{$form->event_title}}</p>
                                <p class="">Current Approver: {{$form->curr_approver}}</p>
                                <p class="lg:text-end">Status: {{$form->status}}</p>
                            </div>
                            <!-- Accordion Body -->
                            <div x-cloak x-transition 
                                x-show="open" 
                                class="bg-white border-2 border-t-0 border-bland-100 px-8">
                                <!-- Accordion Body Top -->
                                <div class="py-4 space-y-2">
                                    <div class="grid grid-cols-2">
                                        <p>Date Submitted: {{$form->created_at}}</p>
                                        <p>Submitted By: {{$form->prep_by}}</p>
                                    </div>
                                    <div class="grid grid-cols-2">
                                        <p>Form Type: {{$form->formable_type}}</p>
                                        <p>Control Number: {{$form->control_number}} </p>
                                    </div>
                                </div>

                                <hr>
                                <!-- Accordion Body Bottom -->
                                <!-- Tracker -->
                                <x-tracker orientation="vertical">
                                   <x-tracker-item orientation="vertical" approver="Adviser" dateApproved="{{$form->adviser_date_approved}}"/>
                                   <x-tracker-item orientation="vertical" approver="SAO Head" dateApproved="{{$form->sao_date_approved}}"/>
                                   <x-tracker-item orientation="vertical" approver="Academic Services Head" dateApproved="{{$form->acadserv_date_approved}}"/>
                                   <x-tracker-item orientation="vertical" approver="Finance Head" dateApproved="{{$form->finance_date_approved}}"/> 
                                </x-tracker>

                                <!-- cancelForm Button && Push Notes -->
                                <div class="flex justify-end space-x-2 my-4">
                                    <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="cancelForm = true,  modal= true">
                                        {{__('Cancel')}}
                                    </x-button>
                                </div>
                               
                                
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>


        {{-- Cancel form modal --}}
        <x-modal name="cancelForm">
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
        </x-modal>
    </div>
</x-app-layout>




