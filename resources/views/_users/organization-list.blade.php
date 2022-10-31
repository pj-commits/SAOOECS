@php
    $isOrgMember = Auth::user()->isOrgMember();
@endphp
<x-app-layout>
    @if(!$isOrgMember)
    <div class="mt-14 h-auto w-full rounded-sm px-6 py-4">
        <div class="flex flex-col justify-center items-center py-16 px-2 md:px-8">
            <img class="w-auto h-auto sm:h-96 object-cover" src="{{ asset('assets/img/group.png')}}" alt="No Organization"/>
            <div class="text-center space-y-3 mt-6">
                <h1 class="text-2xl text-bland-500 font-bold tracking-wide">Woops! You're Not An Organization Member. 😅 </h1>
                <p class="text-sm text-bland-400">You are not yet part of any organization. Why not try joining one? it's fun! </p>
            </div>
        </div>
    </div>
    @else
    <!-- table -->
    <div class="pt-24">    
        <div class="max-w-screen mx-auto px-4 lg:px-8">
            <h1 class="text-xl">Organizations</h1>
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
                        <a class="text-primary-blue hover:text-blue-800 hover:underline hover:underline-offset-4" href="{{ route('organization.show', ['id' => $org->id]) }}" >View</a>
                    </x-table.body-col>
                    {{-- Table Body Columns Ends Here --}}
                </x-table.body>
                @endforeach
            </x-table.main>
            
            <!-- Pagination --->
            <div class="mt-4">
                {{ $authOrgList->links('pagination::tailwind')}}
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
