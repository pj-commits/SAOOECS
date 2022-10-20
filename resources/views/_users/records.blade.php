@php
    $hasRecords = false;
@endphp
<x-app-layout>
    {{-- If there's no record--}}
    @if(!$hasRecords) 
    <div class="mt-14 h-auto w-full rounded-sm px-6 py-4">
        <div class="flex flex-col justify-center items-center py-16 px-2 md:px-8">
            <img class="w-auto h-auto sm:h-96 object-cover" src="{{ asset('assets/img/no-record-found.png')}}" alt="No Organization"/>
            <div class="text-center space-y-3 mt-6">
                <h1 class="text-2xl text-bland-500 font-bold tracking-wide">No Existing Record! 📣 </h1>
                <p class="text-sm text-bland-400">Looks like nothing to see here. </p>
            </div>
        </div>
    </div>
    @else
    {{-- If there's a record --}}
    <!-- Actions -->
    <div class="pt-24">
        <div class="px-4 lg:px-8">
            <form action="">
                @csrf
                <div class="flex items-center justify-end space-x-1">
                    <x-select class="w-48" id="form_type" name="form_type" aria-label="Default select example">
                        <option value="" selected>Form Type</option>
                        <option value="APF">Activity Proposal Form</option>
                        <option value="RF">Requisition Form</option>
                        <option value="NR">Narrative Report</option>
                        <option value="LF">Liquidation Form</option>
                    </x-select>
                    <x-input class="w-48 md:w-64" type="search" id="search" name="search" placeholder="Search"/>
                    <x-button type="submit">
                        <x-svg class="mr-0">
                            <path d="m19.6 21-6.3-6.3q-.75.6-1.725.95Q10.6 16 9.5 16q-2.725 0-4.612-1.887Q3 12.225 3 9.5q0-2.725 1.888-4.613Q6.775 3 9.5 3t4.613 1.887Q16 6.775 16 9.5q0 1.1-.35 2.075-.35.975-.95 1.725l6.3 6.3ZM9.5 14q1.875 0 3.188-1.312Q14 11.375 14 9.5q0-1.875-1.312-3.188Q11.375 5 9.5 5 7.625 5 6.312 6.312 5 7.625 5 9.5q0 1.875 1.312 3.188Q7.625 14 9.5 14Z"/>
                        </x-svg>
                    </x-button>
                </div>
            </form>
        </div>

        <!-- table -->
        <div class="mt-4">
            <div class="max-w-screen mx-auto px-4 lg:px-8">

                <x-table.main>
                    {{-- Table Head--}}
                    <x-table.head>
                        {{-- Insert Table Head Columns Here --}}
                        <x-table.head-col class="pl-6 font-bold">Event Title</x-table.head-col>
                        <x-table.head-col class="pl-6 font-bold">Organization</x-table.head-col>
                        <x-table.head-col class="pl-6 font-bold">Form Type</x-table.head-col>
                        <x-table.head-col class="pl-6 font-bold">Date Submitted</x-table.head-col>
                        <x-table.head-col class="pl-6 font-bold">Date Finished</x-table.head-col>
                        <x-table.head-col class="pl-6 font-bold">Action</x-table.head-col>
                
                    {{-- Table Head Columns Ends Here --}}
                    </x-table.head>
                    {{-- Table Head Body --}}
                    <x-table.body>
                        {{-- Insert Table Body Columns Here --}}
                        <x-table.body-col class="pl-6">HimigKantahan</x-table.body-col>
                        <x-table.body-col class="pl-6">Chorale</x-table.body-col>
                        <x-table.body-col class="pl-6">Activity Proposal Form</x-table.body-col>
                        <x-table.head-col class="pl-6">September 3, 2022 - 2:03 PM</x-table.head-col>
                        <x-table.head-col class="pl-6">September 5, 2022 - 5:32 PM</x-table.head-col>
                        <x-table.body-col class="pl-6">
                            <a class="text-primary-blue hover:text-blue-800 hover:underline hover:underline-offset-4" href="#">Download PDF</a>
                        </x-table.body-col>
                
                        {{-- Table Body Columns Ends Here --}}
                    </x-table.body>
                    
                    
                </x-table.main>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
