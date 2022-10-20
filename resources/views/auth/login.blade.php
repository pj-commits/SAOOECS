<x-guest-layout>
    {{-- All Default Data for Session Storage is initialized here --}}
    <div class="flex bg-primary-blue" x-data="initialize_local_data()">
        {{-- Left Side --}}
        <div class="w-full hidden lg:block lg:basis-1/2">
            <div class="flex justify-center items-center h-screen">
                <img src="{{ asset('assets/img/rams-logo.png')}}" alt="" class="w-72 h-72">
            </div>
        </div>

        {{-- Right Side --}}
        <div class="basis-full lg:basis-1/2">
            <x-auth-card>
                <x-slot name="logo">
                    <img src="{{ asset('assets/img/apc-logo.png') }}" alt="">
                </x-slot>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="relative">
                        <span class="absolute inset-y-0 right-0 flex items-center">
                            <x-svg class="fill-bland-200">
                                <path d="M4 20q-.825 0-1.412-.587Q2 18.825 2 18V6q0-.825.588-1.412Q3.175 4 4 4h16q.825 0 1.413.588Q22 5.175 22 6v12q0 .825-.587 1.413Q20.825 20 20 20Zm8-7L4 8v10h16V8Zm0-2 8-5H4ZM4 8V6v12Z"/>
                            </x-svg>
                        </span>
                        <x-input id="email" placeholder="Email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="relative mt-4">
                        <span class="absolute inset-y-0 right-0 flex items-center">
                            <x-svg class="fill-bland-200">
                               <path d="M6 22q-.825 0-1.412-.587Q4 20.825 4 20V10q0-.825.588-1.413Q5.175 8 6 8h1V6q0-2.075 1.463-3.538Q9.925 1 12 1t3.538 1.462Q17 3.925 17 6v2h1q.825 0 1.413.587Q20 9.175 20 10v10q0 .825-.587 1.413Q18.825 22 18 22Zm0-2h12V10H6v10Zm6-3q.825 0 1.413-.587Q14 15.825 14 15q0-.825-.587-1.413Q12.825 13 12 13q-.825 0-1.412.587Q10 14.175 10 15q0 .825.588 1.413Q11.175 17 12 17ZM9 8h6V6q0-1.25-.875-2.125T12 3q-1.25 0-2.125.875T9 6ZM6 20V10v10Z"/>
                            </x-svg>
                        </span>
                        <x-input id="password" placeholder="Password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        required autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    {{-- <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div> --}}

                    <div class="flex items-center justify-between mt-6 mb-8">
                        @if (Route::has('password.request'))
                            <a class="text-xs text-blue-600 hover:text-blue-900 hover:underline" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-button class="ml-3 px-8" type="submit">
                            {{ __('Sign in') }}
                        </x-button>
                    </div>
                </form>
            </x-auth-card>
        </div>

    </div>

</x-guest-layout>
