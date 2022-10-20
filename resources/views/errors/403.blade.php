<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>403 Forbidden</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="flex items-center justify-center bg-gray-100">
        <div class="max-w-screen mx-auto h-screen px-4 lg:px-8">
            <div class="mt-4 h-auto w-full rounded-sm px-6 py-4">
                <div class="flex flex-col justify-center items-center py-16 px-2 md:px-8">
                    <img class="w-auto h-auto sm:h-96 object-cover" src="{{ asset('assets/img/403.png')}}" alt="No Forms Pending"/>
                    <div class="text-center space-y-3 mt-6">
                        <h1 class="text-2xl text-bland-500 font-bold tracking-wide">Hold Up! ⛔ </h1>
                        <p class="text-sm text-bland-400">You don't have premission to access this resource. </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>