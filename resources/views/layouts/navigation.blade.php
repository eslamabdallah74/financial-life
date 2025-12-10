<nav x-data="{ open: false }" class="navbar-glass border-b border-white border-opacity-20">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div
                            class="w-10 h-10 bg-white bg-opacity-20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-white font-bold text-xl hidden sm:block">Finance Tracker</span>
                    </a>
                </div>

                <!-- Navigation Links - Hidden on mobile, shown in sidebar -->
                <div class="hidden md:flex md:items-center md:ml-10 space-x-4">
                    <a href="{{ route('dashboard') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('dashboard') ? 'bg-white bg-opacity-20' : '' }}">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('transactions.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('transactions.*') ? 'bg-white bg-opacity-20' : '' }}">
                        {{ __('Transactions') }}
                    </a>
                    <a href="{{ route('categories.index') }}"
                        class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-white hover:bg-opacity-20 transition {{ request()->routeIs('categories.*') ? 'bg-white bg-opacity-20' : '' }}">
                        {{ __('Categories') }}
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-white border-opacity-30 text-sm leading-4 font-medium rounded-md text-white bg-white bg-opacity-10 hover:bg-opacity-20 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-white hover:bg-opacity-20 focus:outline-none focus:bg-white focus:bg-opacity-20 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-white bg-white bg-opacity-20 text-white font-semibold' : 'border-transparent text-white hover:bg-white hover:bg-opacity-10 hover:border-white hover:border-opacity-30' }} text-base font-medium transition">
                {{ __('Dashboard') }}
            </a>
            <a href="{{ route('transactions.index') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('transactions.*') ? 'border-white bg-white bg-opacity-20 text-white font-semibold' : 'border-transparent text-white hover:bg-white hover:bg-opacity-10 hover:border-white hover:border-opacity-30' }} text-base font-medium transition">
                {{ __('Transactions') }}
            </a>
            <a href="{{ route('categories.index') }}"
                class="block pl-3 pr-4 py-2 border-l-4 {{ request()->routeIs('categories.*') ? 'border-white bg-white bg-opacity-20 text-white font-semibold' : 'border-transparent text-white hover:bg-white hover:bg-opacity-10 hover:border-white hover:border-opacity-30' }} text-base font-medium transition">
                {{ __('Categories') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-white border-opacity-20">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-white text-opacity-75">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}"
                    class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:bg-white hover:bg-opacity-10 hover:border-white hover:border-opacity-30 transition">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();"
                        class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-white hover:bg-white hover:bg-opacity-10 hover:border-white hover:border-opacity-30 transition">
                        {{ __('Log Out') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</nav>