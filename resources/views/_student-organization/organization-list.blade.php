<x-app-layout>
    <div class="pt-24">
        {{-- If there's no record--}} 
        {{-- <div class="max-w-screen mx-auto px-4 lg:px-8">
            <div class="mt-4 h-auto w-full rounded-sm shadow-sm px-6 py-4">
                <div class="flex flex-col justify-center items-center py-16 px-2 md:px-8">
                    <img class="w-auto h-auto sm:h-96 object-cover" src="{{ asset('assets/img/no-record-found.png')}}" alt="No Forms Pending"/>
                    <div class="text-center space-y-3 mt-3">
                        <h1 class="text-2xl text-bland-500 font-bold tracking-wider">No Existing Record! 📣 </h1>
                        <p class="text-sm text-bland-400">Looks like nothing to see here. </p>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- If there's a record --}}
        <!-- table -->
        <div class="mt-4">
            <div class="max-w-screen mx-auto px-4 lg:px-8">

                <x-table.main>
                    {{-- Table Head--}}
                    <x-table.head>
                        {{-- Insert Table Head Columns Here --}}
                        <x-table.head-col class="pl-6 font-bold">Organization Name</x-table.head-col>
                        <x-table.head-col class="pl-6 font-bold">Adviser</x-table.head-col>
                        <x-table.head-col class="pl-6 font-bold">Action</x-table.head-col>

                
                    {{-- Table Head Columns Ends Here --}}
                    </x-table.head>
                    {{-- Table Head Body --}}
                    @foreach ($authOrgList as $org)
                    <x-table.body>
                        {{-- Insert Table Body Columns Here --}}
                        <x-table.body-col class="pl-6"> {{ $org->org_name }}</x-table.body-col>
                        <x-table.body-col class="pl-6"> {{ $org->adviser }}</x-table.body-col>
                        <x-table.body-col class="pl-6">
                            <a class="text-primary-blue hover:text-blue-800 hover:underline hover:underline-offset-4" href="{{ route('organization.show', ['id' => $org->id, 'invite' => 'false']) }}" >View</a>
                        </x-table.body-col>
                        {{-- Table Body Columns Ends Here --}}
                    </x-table.body>
                    @endforeach
                    
                    
                </x-table.main>
            </div>
        </div>
    </div>
</x-app-layout>
