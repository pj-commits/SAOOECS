@php
    $isModeratorOrEditor = Auth::user()->checkRole('Moderator|Editor');
@endphp
<x-app-layout>
    @if(!$isModeratorOrEditor)
    <div class="mt-8 h-auto w-full rounded-sm px-6 py-4">
        <div class="flex flex-col justify-center items-center py-16 px-2 md:px-8">
            <img class="w-auto h-auto sm:h-96 object-cover" src="{{ asset('assets/img/restricted.png')}}" alt="No Forms Pending"/>
            <div class="text-center space-y-3 mt-6">
                <h1 class="text-2xl text-bland-500 font-bold tracking-wide">Authorized Users Only! 🚫 </h1>
                <p class="text-sm text-bland-400">Sorry, but you don't have permission to access this page. </p>
            </div>
        </div>
    </div>
    @else
    <div class="pt-24" x-data="set_local_storage_data('nr')"> {{-- nr = Narrative Report --}}
        <div class="max-w-screen mx-auto px-4 lg:px-8" x-data="get_local_storage_data('nr')">
            <div class="flex justify-between flex-wrap">
                <h1 class="flex items-center text-xl">
                    <span>
                        <x-svg width="w-7" height="w-7" color="fill-bland-600">
                            <path d="M8 20q-.825 0-1.412-.587Q6 18.825 6 18v-3h3v-2.25q-.875-.05-1.662-.388-.788-.337-1.438-1.012v-1.1H4.75L1.5 7q.9-1.15 2.225-1.625Q5.05 4.9 6.4 4.9q.675 0 1.313.1.637.1 1.287.375V4h12v13q0 1.25-.875 2.125T18 20Zm3-5h6v2q0 .425.288.712.287.288.712.288t.712-.288Q19 17.425 19 17V6h-8v.6l6 6V14h-1.4l-2.85-2.85-.2.2q-.35.35-.738.625-.387.275-.812.425ZM5.6 8.25h2.3v2.15q.3.2.625.275.325.075.675.075.575 0 1.038-.175.462-.175.912-.625l.2-.2-1.4-1.4q-.725-.725-1.625-1.088Q7.425 6.9 6.4 6.9q-.5 0-.95.075-.45.075-.9.225ZM8 18h7.15q-.075-.225-.112-.475Q15 17.275 15 17H8Zm0 0v-1 1Z"/>
                        </x-svg>
                    </span> 
                    Narrative Report
                </h1>
                <x-button @click="clear_form_local_storage('nr', true), loading(true)">
                    <x-svg>
                        <path d="M11 20.95q-3.025-.375-5.012-2.638Q4 16.05 4 13q0-1.65.65-3.163Q5.3 8.325 6.5 7.2l1.425 1.425q-.95.85-1.437 1.975Q6 11.725 6 13q0 2.2 1.4 3.887 1.4 1.688 3.6 2.063Zm2 0v-2q2.175-.4 3.587-2.075Q18 15.2 18 13q0-2.5-1.75-4.25T12 7h-.075l1.1 1.1-1.4 1.4-3.5-3.5 3.5-3.5 1.4 1.4-1.1 1.1H12q3.35 0 5.675 2.325Q20 9.65 20 13q0 3.025-1.987 5.288Q16.025 20.55 13 20.95Z"/>
                    </x-svg>
                    {{ __('Reset') }}
                </x-button>
            </div>
            <hr class="mt-3">
            <div class="bg-white mt-4 h-auto w-full rounded-sm shadow-sm px-6 py-4">
                <form action="{{ route('test') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    {{-- Row #1 --}}               
                    <div class="grid grid-flow-row auto-rows-max gap-6 md:grid-cols-2">

                        {{-- Event Title --}}
                        <div>
                            <x-label for="event_title" :value="__('Event Title')" />

                             <x-select class="mt-1" id="event_title" name="event_title" aria-label="Default select example" @change="storeInput($el)">
                                <option value='' selected disabled>--select option--</option>
                            </x-select>
                        </div>

                        {{-- Date Venue --}}
                        <div>
                            <x-label for="venue" :value="__('Venue')" />
                            
                            <x-input id="venue" class="mt-1 w-full" type="text" name="venue" required autofocus @keyup="storeInput($el)"/>
                        </div>

                    </div>

                    {{-- Row #2 --}}          
                    <div class="mt-2">
                        <x-label for="remarks" :value="__('Remarks')" />

                        <x-text-area id="remarks" name="remarks" @keyup="storeInput($el)"></x-text-area>
                    
                    </div>


                    {{-- Row #3 Program Table --}}
                    <hr class="mt-6 border-1 border-bland-300">

                    <h1 class="text-lg text-bland-600 font-bold my-4">Programs</h1>

                    <div x-data="program_handler()">
                        <x-table.main>
                            {{-- Table Head--}}
                            <x-table.head>
                                {{-- Insert Table Head Columns Here --}}
                                <x-table.head-col>Activity</x-table.head-col>
                                <x-table.head-col>Start Date</x-table.head-col>
                                <x-table.head-col>End Date</x-table.head-col>
                                <x-table.head-col class="text-center">Action</x-table.head-col>
                                {{-- Table Head Columns Ends Here --}}
                            </x-table.head>
                            {{-- Table Body --}}
                            <tbody>
                                <template x-for="(field, index) in programs[0]" :key="index">
                                    <tr class="bg-white  hover:bg-bland-100">
                                        {{-- Insert Table Body Columns Here --}}
                                        <x-table.body-col>
                                            <x-input x-model="field.activity"  id="activity" class="mt-1 w-full" type="text" name="activity[]"  readonly autofocus />
                                        </x-table.body-col>
                                        <x-table.body-col>
                                            <x-input x-model="field.start_date" id="start_date" class="mt-1 w-full" type="datetime-local" name="start_date[]"  readonly autofocus />
                                        </x-table.body-col>
                                        <x-table.body-col>
                                            <x-input x-model="field.end_date" id="end_date" class="mt-1 w-full" type="datetime-local" name="end_date[]" readonly autofocus />
                                        </x-table.body-col>
                                        <x-table.body-col class="text-center">
                                            <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="removeProgram(index)">
                                                {{ __('Remove') }}
                                            </x-button>
                                        </x-table.body-col>
                                        {{-- Table Body Columns Ends Here --}}
                                    </tr>
                                </template>
                            </tbody>
                            <tfoot class="border-t border-bland-200">
                                <tr>
                                    {{-- Insert Table Footer Columns Here --}}
                                    <x-table.footer-col>
                                        <x-input x-model="newPrograms[0].activity" class="mt-1 w-full" type="text" autofocus />
                                    </x-table.footer-col>
                                    <x-table.footer-col>
                                        <x-input x-model="newPrograms[0].start_date" class="mt-1 w-full" type="datetime-local" autofocus />
                                    </x-table.footer-col>
                                    <x-table.footer-col>
                                        <x-input x-model="newPrograms[0].end_date" class="mt-1 w-full" type="datetime-local" autofocus />
                                    </x-table.footer-col>
                                    <x-table.footer-col class="px-1 text-center" @click=addProgram>
                                        <x-button>
                                            {{ __('Add Row') }}
                                        </x-button>
                                    </x-table.footer-col>
                                    {{-- Table Footer Columns Ends Here --}}
                                </tr>
                            </tfoot>
                        </x-table.main>
                        <span x-show="error" class="flex text-sm text-semantic-danger font-light">*<p x-text="msg"></p></span>
                    </div>


                    {{-- Row #4 Participants Table --}}
                    <hr class="mt-6 border-1 border-bland-300">

                    <div x-data="participant_handler()">

                        <div class="flex justify-between items-end mt-4">

                            <h1 class="text-lg text-bland-600 font-bold">Participants</h1>

                        </div>
                    
                        {{-- Custom table --}}
                        <div class="bg-white mt-4 h-auto w-full border-b border-gray-200 shadow-sm">
                            <div id="participant-container" class="overflow-auto block max-h-[420px] rounded-sm scroll-smooth">
                                <table class="table-auto w-full border-collapse border text-left">
                        
                                    {{-- Table Head--}}
                                    <thead class="border-b bg-bland-200 sticky top-0 z-10">
                                        {{-- Insert Table Head Columns Here --}}
                                        <x-table.head-col>First Name</x-table.head-col>
                                        <x-table.head-col>Last Name</x-table.head-col>
                                        <x-table.head-col>Section</x-table.head-col>
                                        <x-table.head-col>Participated Date</x-table.head-col>
                                        <x-table.head-col class="text-center">Action</x-table.head-col>
                                        {{-- Table Head Columns Ends Here --}}
                                    </thead>
                                    {{-- Table Body --}}
                                    <tbody>
                                        <template x-for="(field, index) in participants[0]" :key="index">
                                            <tr class="bg-white hover:bg-bland-100 w-full transition duration-300 ease-in-out">
                                                {{-- Insert Table Body Columns Here --}}
                                                <x-table.body-col>
                                                    <x-input x-model="field.first_name"  id="first_name" class="mt-1 w-full" type="text" name="first_name[]"  readonly autofocus />
                                                </x-table.body-col>
                                                <x-table.body-col>
                                                    <x-input x-model="field.last_name" id="last_name" class="mt-1 w-full" type="text" name="last_name[]"  readonly autofocus />
                                                </x-table.body-col>
                                                <x-table.body-col>
                                                    <x-input x-model="field.section" id="section" class="mt-1 w-full" type="text" name="section[]" readonly autofocus />
                                                </x-table.body-col>
                                                <x-table.body-col>
                                                <x-input x-model="field.participated_date" id="participated_date" class="mt-1 w-full" type="date" name="participated_date[]" readonly autofocus />
                                            </x-table.body-col>
                                                <x-table.body-col class="text-center">
                                                    <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="removeParticipant(index)">
                                                        {{ __('Remove') }}
                                                    </x-button>
                                                </x-table.body-col>
                                                {{-- Table Body Columns Ends Here --}}
                                            </tr>
                                        </template>
                                    </tbody>
                                    <tfoot class="border-t border-bland-200 bg-white sticky bottom-0">
                                        <tr>
                                            {{-- Insert Table Footer Columns Here --}}
                                            <x-table.footer-col>
                                                <x-input x-model="newParticipants[0].first_name" class="mt-1 w-full" type="text" autofocus />
                                            </x-table.footer-col>
                                            <x-table.footer-col>
                                                <x-input x-model="newParticipants[0].last_name" class="mt-1 w-full" type="text" autofocus />
                                            </x-table.footer-col>
                                            <x-table.footer-col>
                                                <x-input x-model="newParticipants[0].section" class="mt-1 w-full" type="text" autofocus />
                                            </x-table.footer-col>
                                            <x-table.footer-col>
                                            <x-input x-model="newParticipants[0].participated_date" class="mt-1 w-full" type="date" autofocus />
                                        </x-table.footer-col>
                                            <x-table.footer-col class="px-1 text-center">
                                                <x-button @click="addParticipant">
                                                    {{ __('Add Row') }}
                                                </x-button>
                                            </x-table.footer-col>
                                            {{-- Table Footer Columns Ends Here --}}
                                        </tr>
                                    </tfoot>
                        
                                </table>
                            </div>
                        </div>
                        <span x-show="error" class="flex text-sm text-semantic-danger font-light">*<p x-text="msg"></p></span>

                    
                        <div class="flex justify-end mt-2">

                            <x-button>
                                
                                <x-svg>
                                    <path d="M6 20q-.825 0-1.412-.587Q4 18.825 4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413Q18.825 20 18 20Zm5-4V7.85l-2.6 2.6L7 9l5-5 5 5-1.4 1.45-2.6-2.6V16Z"/>
                                </x-svg>
                                {{ __('Upload CSV') }}

                                <input 
                                    type="file" 
                                    name="participants_csv" 
                                    id="participants_csv" 
                                    accept=".csv"
                                    class="absolute cursor-pointer right-0 opacity-0"
                                    @change="readCSV, loading(true)"
                                >

                            </x-button>
                        </div>

                    </div>
                   

                    {{-- Row #6 --}}
                    <hr class="mt-6 border-1 border-bland-300">

                    <div class="flex justify-center align-center flex-wrap pt-3 space-y-3 md:space-y-0 md:space-x-3">

                        <!-- Official Poster -->
                        <div class="w-full p-3 border-2 border-dashed hover:border-primary-blue md:w-[49%]">
                        
                            <div>
                                <h1 class="text-lg text-bland-600  my-2 pb-2">Official Poster</h1>
                                <livewire:single-upload />
                            </div>

                        </div>
                    
                        <!-- Event Images -->
                        <div class="w-full p-3 border-2 border-dashed hover:border-primary-blue md:w-[49%]">

                            <div>
                                <h1 class="text-lg text-bland-600 my-2">Event Images</h1>
                                <livewire:multiple-upload />
                            </div>

                        </div>

                    </div>

                    {{-- Row #7 Comments Table --}}
                    <div x-data="comment_suggestion_handler()">
                        <hr class="mt-6 border-1 border-bland-300">

                            <div class="flex justify-between items-end mt-4">

                                <h1 class="text-lg text-bland-600 font-bold">Comments</h1>

                            </div>
                        
                            {{-- Custom table --}}
                            <div class="bg-white mt-4 h-auto w-full border-b border-gray-200 shadow-sm">
                                <div id="participant-container" class="overflow-auto block max-h-[420px] rounded-sm scroll-smooth">
                                    <table class="table-auto w-full border-collapse border text-left">
                            
                                        {{-- Table Head--}}
                                        <thead class="border-b bg-bland-200 sticky top-0 z-10">
                                            {{-- Insert Table Head Columns Here --}}
                                            <x-table.head-col class="md:pr-96">Message</x-table.head-col>
                                            <x-table.head-col class="text-center">Action</x-table.head-col>
                                            {{-- Table Head Columns Ends Here --}}
                                        </thead>
                                        {{-- Table Body --}}
                                        <tbody>
                                            <template x-for="(field, index) in comments[0]" :key="index">
                                                <tr class="bg-white  hover:bg-bland-100">
                                                    {{-- Insert Table Body Columns Here --}}
                                                    <x-table.body-col>
                                                        <x-input x-model="field.message"  id="comment" class="mt-1 w-full" type="text" name="comments[]"  readonly autofocus />
                                                    </x-table.body-col>
                                                    <x-table.body-col class="text-center">
                                                        <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="removeComment(index)">
                                                            {{ __('Remove') }}
                                                        </x-button>
                                                    </x-table.body-col>
                                                    {{-- Table Body Columns Ends Here --}}
                                                </tr>
                
                                            </template>
                                        </tbody>
                                        <tfoot class="border-t border-bland-200 bg-white sticky bottom-0">
                                        <tr>
                                        {{-- Insert Table Footer Columns Here --}}
                                        <x-table.footer-col>
                                            <x-input x-model="newComments[0].message" class="mt-1 w-full" type="text" autofocus />
                                        </x-table.footer-col>
                                        <x-table.footer-col class="px-1 text-center" @click="addComment">
                                            <x-button>
                                                {{ __('Add Row') }}
                                            </x-button>
                                        </x-table.footer-col>
                                        {{-- Table Footer Columns Ends Here --}}
                                    </tr>
                                        </tfoot>
                            
                                    </table>
                                </div>
                            </div>
                            <span x-show="err_comments" class="flex text-sm text-semantic-danger font-light">*<p x-text="msg_comments"></p></span>


                        {{-- Row #8 Suggestions Table --}}

                            <div class="flex justify-between items-end mt-4">

                                <h1 class="text-lg text-bland-600 font-bold">Suggestions</h1>

                                <div>

                                </div>

                            </div>
                        
                            {{-- Custom table --}}
                            <div class="bg-white mt-4 h-auto w-full border-b border-gray-200 shadow-sm">
                                <div id="participant-container" class="overflow-auto block max-h-[420px] rounded-sm scroll-smooth">
                                    <table class="table-auto w-full border-collapse border text-left">
                            
                                        {{-- Table Head--}}
                                        <thead class="border-b bg-bland-200 sticky top-0 z-10">
                                            {{-- Insert Table Head Columns Here --}}
                                            <x-table.head-col class="md:pr-96">Message</x-table.head-col>
                                            <x-table.head-col class="text-center">Action</x-table.head-col>
                                            {{-- Table Head Columns Ends Here --}}
                                        </thead>
                                        {{-- Table Body --}}
                                        <tbody>
                                            <template x-for="(field, index) in suggestions[0]" :key="index">
                                                <tr class="bg-white  hover:bg-bland-100">
                                                    {{-- Insert Table Body Columns Here --}}
                                                    <x-table.body-col>
                                                        <x-input x-model="field.message"  id="comment" class="mt-1 w-full" type="text" name="suggestions[]"  readonly autofocus />
                                                    </x-table.body-col>
                                                    <x-table.body-col class="text-center">
                                                        <x-button bg="bg-semantic-danger" hover="hover:bg-rose-600" @click="removeSuggestion(index)">
                                                            {{ __('Remove') }}
                                                        </x-button>
                                                    </x-table.body-col>
                                                    {{-- Table Body Columns Ends Here --}}
                                                </tr>
                
                                            </template>
                                        </tbody>
                                        <tfoot class="border-t border-bland-200 bg-white sticky bottom-0">
                                        <tr>
                                        {{-- Insert Table Footer Columns Here --}}
                                        <x-table.footer-col>
                                            <x-input x-model="newSuggestions[0].message" class="mt-1 w-full" type="text" autofocus />
                                        </x-table.footer-col>
                                        <x-table.footer-col class="px-1 text-center" @click="addSuggestion">
                                            <x-button>
                                                {{ __('Add Row') }}
                                            </x-button>
                                        </x-table.footer-col>
                                        {{-- Table Footer Columns Ends Here --}}
                                    </tr>
                                        </tfoot>
                            
                                    </table>
                                </div>
                            </div>
                            <span x-show="err_suggestions" class="flex text-sm text-semantic-danger font-light">*<p x-text="msg_suggestions"></p></span>
                            <div class="flex justify-end items-center mt-4 space-x-2">

                                <p class="text-xs text-bland-400 font-light italic">*For Comments, Suggestions, and Rating</p>
                                <x-button>
                                    
                                    <x-svg>
                                        <path d="M6 20q-.825 0-1.412-.587Q4 18.825 4 18v-3h2v3h12v-3h2v3q0 .825-.587 1.413Q18.825 20 18 20Zm5-4V7.85l-2.6 2.6L7 9l5-5 5 5-1.4 1.45-2.6-2.6V16Z"/>
                                    </x-svg>
                                    {{ __('Upload CSV') }}

                                    <input 
                                        type="file" 
                                        name="comments_csv" 
                                        id="comments_csv" 
                                        accept=".csv"
                                        class="absolute cursor-pointer right-0 opacity-0"
                                        @change="readCSV, loading('true')"
                                    >

                                </x-button>
                            </div>


                        {{-- Row #9 --}}               
                        <div class="grid grid-flow-row auto-rows-max mt-4 md:grid-cols-4">

                            {{-- Rating --}}
                            <div>
                                <x-label for="ratings" :value="__('Rating')" />
                                
                                <x-input x-model="getTotalRating" id="ratings" class="mt-1 w-full" type="number" name="ratings" step=".1" required autofocus @keyup="storeInput($el)"/>
                                <span x-show="err_ratings" class="flex text-sm text-semantic-danger font-light">*<p x-text="msg_ratings"></p></span>
                            </div>

                        </div>
            
                    </div>

                   
                    
                    {{-- Submit Button--}}
                    <div class="mt-8">
                        <x-button type="submit" class="px-12">
                            {{ __('Submit') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>












