<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Finance Tracker') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Main Layout with Sidebar -->
        <div class="flex">
            <!-- Sidebar - Hidden on mobile, shown on desktop -->
            <aside
                class="hidden lg:flex lg:flex-col w-64 bg-white shadow-sm min-h-screen fixed left-0 top-16 bottom-0 overflow-y-auto scrollbar-hide">
                <nav class="flex-1 px-4 py-6 space-y-1">
                    <a href="{{ route('dashboard') }}"
                        class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('transactions.index') }}"
                        class="sidebar-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Transactions</span>
                    </a>

                    <a href="{{ route('categories.index') }}"
                        class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span>Categories</span>
                    </a>

                    <!-- Divider -->
                    <div class="border-t border-gray-200 my-4"></div>

                    <!-- Additional Quick Stats -->
                    <div class="px-3 py-4">
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Quick Stats</p>
                        <div class="space-y-2">
                            <div class="text-xs text-gray-600">
                                <span class="font-medium">Total Balance</span>
                                <div class="text-lg font-bold text-gradient">$0.00</div>
                            </div>
                        </div>
                    </div>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 lg:ml-64 transition-all duration-300">
                <div class="py-8 px-4 sm:px-6 lg:px-8">
                    <div class="max-w-7xl mx-auto">
                        {{ $slot }}
                    </div>
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>