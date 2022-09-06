<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SAO OECS') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        {{-- Screen Loading --}}
        <script defer src="{{ asset('js/screen-loader.js')}}"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <style>
        [x-cloak] { display: none !important; }
    </style>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 lg:pl-64">
            
            <!-- Page Heading -->
            <header class="flex items-center h-auto" x-data="{ open: false }">
                <nav class="relative flex items-center w-full">
                    @include('layouts.navigation')
                    @include('layouts.sidebar')
                </nav>
            </header>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        {{--
            
            !! Comment this out to turn off loading screen !!

        --}}
        <div id="loader" class=" flex flex-col space-y-6 items-center justify-center z-20 fixed top-0 left-0 w-screen h-screen bg-slate-300 bg-opacity-60">
            <img src="{{ asset('assets/svg/screen-loader-animation/ball-triangle.svg') }}" alt="">
            <p class="text-sm text-gray-500">Loading...</p>
        </div> 
    </body>
</html>
