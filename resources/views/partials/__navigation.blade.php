<!-- Top Menu -->
<div class="w-full bg-white fixed top-0 right-0 z-30">
    <div class="flex justify-between md:justify-end h-16 border-b-4 border-primary-yellow ">
        <!-- Mobile Header -->
        <div class="inline-flex items-center justify-center lg:hidden">
            <a href="#" @click="open = true" class="absolute left-0 pl-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 stroke-bland-400 hover:stroke-bland-600" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
             </a>
        </div>

        <!-- Settings Dropdown -->
        <div class="flex items-center mr-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center text-sm font-medium text-bland-400 hover:text-bland-600 hover:border-gray-300 focus:outline-none focus:text-bland-600 focus:border-gray-300 transition duration-150 ease-in-out">
                        <div>{{ Auth::user()->firstName }} {{ Auth::user()->lastName}}</div>

                        <div class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</div>

