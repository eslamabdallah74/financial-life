<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Tracker - Master Your Money</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        * {
            font-family: 'Inter', sans-serif;
        }

        @keyframes gradient-shift {

            0%,
            100% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-20px) rotate(2deg);
            }

            66% {
                transform: translateY(-10px) rotate(-2deg);
            }
        }

        @keyframes pulse-glow {

            0%,
            100% {
                box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
            }

            50% {
                box-shadow: 0 0 40px rgba(99, 102, 241, 0.6);
            }
        }

        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scale-in {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        .gradient-bg {
            background: linear-gradient(-45deg, #667eea, #764ba2, #f093fb, #4facfe);
            background-size: 400% 400%;
            animation: gradient-shift 15s ease infinite;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .animate-slide-up {
            animation: slide-up 0.8s ease-out forwards;
        }

        .animate-scale-in {
            animation: scale-in 0.6s ease-out forwards;
        }

        .animate-float {
            animation: float 8s ease-in-out infinite;
        }

        .glow-card {
            transition: all 0.3s ease;
        }

        .glow-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(99, 102, 241, 0.3);
        }

        .shimmer-effect {
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.8), transparent);
            background-size: 1000px 100%;
            animation: shimmer 3s infinite;
        }

        .gradient-text {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .feature-icon {
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            transform: scale(1.1) rotate(5deg);
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: float 20s ease-in-out infinite;
        }

        .nav-link {
            position: relative;
            transition: color 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .scroll-indicator {
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .stats-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
            backdrop-filter: blur(10px);
        }

        .navbar-hidden {
            transform: translateY(-100%);
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .mobile-menu.active {
            max-height: 500px;
        }

        .hamburger span {
            display: block;
            width: 100%;
            height: 2px;
            background: white;
            transition: all 0.3s ease;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }
    </style>
</head>

<body class="antialiased bg-gray-950 text-gray-100 overflow-x-hidden">

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 transition-all duration-500" id="navbar">
        <div class="glass-effect border-b border-white/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">
                    <div class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur-lg opacity-50 group-hover:opacity-75 transition-opacity">
                            </div>
                            <div
                                class="relative w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <span
                            class="text-2xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">Finance
                            Tracker</span>
                    </div>

                    <div class="hidden md:flex items-center gap-8">
                        <a href="#features"
                            class="nav-link text-gray-300 hover:text-white font-medium transition-all">Features</a>
                        <a href="#benefits"
                            class="nav-link text-gray-300 hover:text-white font-medium transition-all">Benefits</a>
                        <a href="#pricing"
                            class="nav-link text-gray-300 hover:text-white font-medium transition-all">Pricing</a>
                    </div>

                    <div class="flex items-center gap-4">
                        <button
                            class="hidden sm:block px-6 py-2.5 text-sm font-semibold text-gray-300 hover:text-white transition-all hover:scale-105">Login</button>
                        <button
                            class="relative px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-bold rounded-xl overflow-hidden group shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 transition-all duration-300">
                            <span class="relative z-10">Get Started</span>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300">
                            </div>
                        </button>

                        <!-- Mobile Menu Button -->
                        <button class="md:hidden hamburger w-10 h-10 flex flex-col justify-center items-center gap-1.5"
                            id="mobileMenuBtn">
                            <span class="w-6 h-0.5 bg-white"></span>
                            <span class="w-6 h-0.5 bg-white"></span>
                            <span class="w-6 h-0.5 bg-white"></span>
                        </button>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div class="mobile-menu md:hidden" id="mobileMenu">
                    <div class="py-4 space-y-3">
                        <a href="#features"
                            class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition-all">Features</a>
                        <a href="#benefits"
                            class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition-all">Benefits</a>
                        <a href="#pricing"
                            class="block px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition-all">Pricing</a>
                        <div class="pt-3 border-t border-white/10">
                            <button
                                class="w-full px-4 py-3 text-gray-300 hover:text-white hover:bg-white/5 rounded-lg transition-all text-left">Login</button>
                            <button
                                class="w-full mt-2 px-4 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-lg">Get
                                Started</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
        <!-- Animated Background Blobs -->
        <div class="blob w-96 h-96 bg-indigo-500 top-20 -left-48" style="animation-delay: 0s;"></div>
        <div class="blob w-96 h-96 bg-purple-500 bottom-20 -right-48" style="animation-delay: 2s;"></div>
        <div class="blob w-96 h-96 bg-pink-500 top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
            style="animation-delay: 4s;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Left Content -->
                <div class="space-y-8 animate-slide-up">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-white/5 backdrop-blur-sm rounded-full border border-white/10">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
                        </span>
                        <span class="text-sm font-medium bg-gradient-to-r from-indigo-300 to-purple-300 bg-clip-text text-transparent">🚀 Over 50,000 users trust us</span>
                    </div>

                    <h1 class="text-6xl sm:text-7xl lg:text-8xl font-black leading-none">
                        <span class="text-white">Master Your</span>
                        <br>
                        <span class="gradient-text">Financial Life</span>
                    </h1>

                    <p class="text-xl text-gray-300 leading-relaxed max-w-xl font-medium">
                        Transform the way you manage money with <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-purple-400">intelligent insights</span>, powerful automation, and beautiful
                        design. Your financial freedom starts <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">here</span>.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <button
                            class="group relative px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-bold rounded-2xl overflow-hidden transform hover:scale-105 transition-all">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                Start Free Trial
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </span>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-purple-600 to-pink-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left">
                            </div>
                        </button>
                        <button
                            class="px-8 py-4 bg-white/5 backdrop-blur-sm border border-white/10 text-white font-bold rounded-2xl hover:bg-white/10 transition-all">
                            Watch Demo
                        </button>
                    </div>

                    <div class="flex items-center gap-8 pt-4">
                        <div>
                            <div class="text-3xl font-bold text-white">4.9/5</div>
                            <div class="flex items-center gap-1 mt-1">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            </div>
                            <p class="text-sm text-gray-300 mt-1 font-medium">From 2,847 reviews</p>
                        </div>
                        <div class="h-12 w-px bg-white/10"></div>
                        <div>
                            <div class="text-3xl font-bold text-white">$2.4B+</div>
                            <p class="text-sm text-gray-300 mt-1 font-medium">Tracked by users</p>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Dashboard Preview -->
                <div class="relative animate-float" style="animation-delay: 0.2s;">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-3xl blur-3xl opacity-30">
                    </div>

                    <div class="relative glass-effect rounded-3xl p-8 shadow-2xl border border-white/20">
                        <div class="space-y-6">
                            <!-- Balance Card -->
                            <div class="relative overflow-hidden rounded-2xl p-8 gradient-bg">
                                <div class="relative z-10">
                                    <p class="text-white/80 text-sm font-medium mb-2">Total Balance</p>
                                    <p class="text-5xl font-black text-white mb-4">$24,590</p>
                                    <div class="flex items-center gap-2 text-white/90">
                                        <svg class="w-5 h-5 text-green-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                        </svg>
                                        <span class="text-sm font-semibold">+12.5% this month</span>
                                    </div>
                                </div>
                                <div class="absolute top-0 right-0 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                            </div>

                            <!-- Income/Expense Cards -->
                            <div class="grid grid-cols-2 gap-4">
                                <div class="stats-card rounded-2xl p-6 border border-white/10">
                                    <div class="flex items-center justify-between mb-3">
                                        <div
                                            class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-gray-400 text-sm mb-1">Income</p>
                                    <p class="text-2xl font-bold text-white">$8,420</p>
                                </div>

                                <div class="stats-card rounded-2xl p-6 border border-white/10">
                                    <div class="flex items-center justify-between mb-3">
                                        <div
                                            class="w-12 h-12 bg-red-500/20 rounded-xl flex items-center justify-center">
                                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-gray-400 text-sm mb-1">Expenses</p>
                                    <p class="text-2xl font-bold text-white">$4,240</p>
                                </div>
                            </div>

                            <!-- Quick Stats -->
                            <div class="flex items-center justify-between py-4 border-t border-white/10">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></div>
                                    <span class="text-sm text-gray-300">Real-time sync</span>
                                </div>
                                <div class="flex -space-x-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-400 to-purple-400 border-2 border-gray-900">
                                    </div>
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-br from-purple-400 to-pink-400 border-2 border-gray-900">
                                    </div>
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-br from-pink-400 to-red-400 border-2 border-gray-900">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 scroll-indicator">
            <svg class="w-6 h-6 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="relative py-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 animate-slide-up">
                <div class="inline-block mb-4">
                    <span
                        class="px-4 py-2 bg-indigo-500/10 border border-indigo-500/20 rounded-full text-sm font-semibold text-indigo-400">POWERFUL
                        FEATURES</span>
                </div>
                <h2 class="text-5xl sm:text-6xl font-black text-white mb-6">
                    Everything You Need,
                    <span class="gradient-text">Nothing You Don't</span>
                </h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto font-medium">
                    Built with <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 to-cyan-300">cutting-edge technology</span> and designed for simplicity. Manage your finances like never
                    before.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div
                    class="feature-card group glow-card glass-effect rounded-3xl p-8 border border-white/10 hover:border-indigo-500/50 transition-all cursor-pointer">
                    <div
                        class="feature-icon w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:shadow-xl group-hover:shadow-indigo-500/50">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-white to-indigo-200 bg-clip-text text-transparent mb-3">Smart Analytics</h3>
                    <p class="text-gray-300 leading-relaxed">AI-powered insights that reveal spending patterns and help
                        you make <span class="text-indigo-300 font-semibold">smarter financial decisions</span>.</p>
                </div>

                <!-- Feature Card 2 -->
                <div
                    class="feature-card group glow-card glass-effect rounded-3xl p-8 border border-white/10 hover:border-green-500/50 transition-all cursor-pointer">
                    <div
                        class="feature-icon w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-6 group-hover:shadow-xl group-hover:shadow-green-500/50">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-white to-green-200 bg-clip-text text-transparent mb-3">Real-time Sync</h3>
                    <p class="text-gray-300 leading-relaxed">Instant updates across all your devices. Your data is
                        always <span class="text-green-300 font-semibold">current</span>, always <span class="text-green-300 font-semibold">secure</span>.</p>
                </div>

                <!-- Feature Card 3 -->
                <div
                    class="feature-card group glow-card glass-effect rounded-3xl p-8 border border-white/10 hover:border-blue-500/50 transition-all cursor-pointer">
                    <div
                        class="feature-icon w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-2xl flex items-center justify-center mb-6 group-hover:shadow-xl group-hover:shadow-blue-500/50">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent mb-3">Bank-Level Security</h3>
                    <p class="text-gray-300 leading-relaxed"><span class="text-blue-300 font-semibold">256-bit encryption</span> and biometric authentication keep your
                        financial data completely secure.</p>
                </div>

                <!-- Feature Card 4 -->
                <div
                    class="feature-card group glow-card glass-effect rounded-3xl p-8 border border-white/10 hover:border-pink-500/50 transition-all cursor-pointer">
                    <div
                        class="feature-icon w-16 h-16 bg-gradient-to-br from-pink-500 to-rose-600 rounded-2xl flex items-center justify-center mb-6 group-hover:shadow-xl group-hover:shadow-pink-500/50">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Budget Goals</h3>
                    <p class="text-gray-400 leading-relaxed">Set smart budget targets and track progress with visual
                        indicators and intelligent alerts.</p>
                </div>

                <!-- Feature Card 5 -->
                <div
                    class="feature-card group glow-card glass-effect rounded-3xl p-8 border border-white/10 hover:border-yellow-500/50 transition-all cursor-pointer">
                    <div
                        class="feature-icon w-16 h-16 bg-gradient-to-br from-yellow-500 to-orange-600 rounded-2xl flex items-center justify-center mb-6 group-hover:shadow-xl group-hover:shadow-yellow-500/50">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Smart Categories</h3>
                    <p class="text-gray-400 leading-relaxed">Automatically categorize expenses with machine learning for
                        effortless organization.</p>
                </div>

                <!-- Feature Card 6 -->
                <div
                    class="feature-card group glow-card glass-effect rounded-3xl p-8 border border-white/10 hover:border-purple-500/50 transition-all cursor-pointer">
                    <div
                        class="feature-icon w-16 h-16 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-2xl flex items-center justify-center mb-6 group-hover:shadow-xl group-hover:shadow-purple-500/50">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-3">Mobile First</h3>
                    <p class="text-gray-400 leading-relaxed">Beautiful native apps for iOS and Android. Manage finances
                        on-the-go with ease.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 opacity-10"></div>
        <div class="blob w-96 h-96 bg-indigo-500 top-0 left-0" style="animation-delay: 1s;"></div>
        <div class="blob w-96 h-96 bg-purple-500 bottom-0 right-0" style="animation-delay: 3s;"></div>

        <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="glass-effect rounded-3xl p-12 md:p-20 border border-white/10">
                <div class="inline-block mb-6">
                    <span
                        class="px-4 py-2 bg-indigo-500/20 border border-indigo-500/30 rounded-full text-sm font-semibold text-indigo-300">LIMITED
                        TIME OFFER</span>
                </div>
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-black text-white mb-6">
                    Ready to Take Control?
                </h2>
                <p class="text-xl text-gray-200 mb-10 max-w-2xl mx-auto leading-relaxed font-medium">
                    Join over <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-300 to-purple-300 font-bold">50,000 users</span> who've transformed their financial lives. Start your free 30-day trial
                    today—<span class="text-green-300 font-semibold">no credit card required</span>.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <button
                        class="group relative px-10 py-5 bg-white text-gray-900 font-bold rounded-2xl overflow-hidden transform hover:scale-105 transition-all shadow-2xl">
                        <span class="relative z-10 flex items-center justify-center gap-2">
                            Start Free Trial
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </span>
                    </button>
                    <button
                        class="px-10 py-5 bg-white/5 backdrop-blur-sm border border-white/20 text-white font-bold rounded-2xl hover:bg-white/10 transition-all">
                        Schedule Demo
                    </button>
                </div>
                <p class="mt-8 text-sm text-gray-400">✨ Free forever plan • No credit card required • Cancel anytime</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="relative bg-gray-950 border-t border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-12 mb-12">
                <!-- Brand Column -->
                <div class="lg:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="relative">
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-2xl blur-lg opacity-50">
                            </div>
                            <div
                                class="relative w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <span class="text-2xl font-bold text-white">Finance Tracker</span>
                    </div>
                    <p class="text-gray-400 mb-6 leading-relaxed max-w-sm">
                        The modern way to manage your money. Track expenses, set budgets, and achieve your financial
                        goals with ease.
                    </p>
                    <div class="flex gap-4">
                        <a href="#"
                            class="w-10 h-10 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl flex items-center justify-center text-gray-400 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl flex items-center justify-center text-gray-400 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl flex items-center justify-center text-gray-400 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z" />
                            </svg>
                        </a>
                        <a href="#"
                            class="w-10 h-10 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl flex items-center justify-center text-gray-400 hover:text-white transition-all">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Product Column -->
                <div>
                    <h4 class="text-white font-bold mb-4">Product</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Features</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Pricing</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Security</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Roadmap</a></li>
                    </ul>
                </div>

                <!-- Company Column -->
                <div>
                    <h4 class="text-white font-bold mb-4">Company</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>

                <!-- Resources Column -->
                <div>
                    <h4 class="text-white font-bold mb-4">Resources</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Documentation</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">API</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Community</a></li>
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="pt-8 border-t border-white/5">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-400">
                        © 2024 Finance Tracker. All rights reserved.
                    </p>
                    <div class="flex gap-6">
                        <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Privacy Policy</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Terms of
                            Service</a>
                        <a href="#" class="text-sm text-gray-400 hover:text-white transition-colors">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navbar scroll effect with hide/show
        const navbar = document.getElementById('navbar');
        let lastScroll = 0;
        const scrollThreshold = 100;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            // Add shadow when scrolled
            if (currentScroll <= 0) {
                navbar.classList.remove('shadow-2xl', 'shadow-indigo-500/10');
            } else {
                navbar.classList.add('shadow-2xl', 'shadow-indigo-500/10');
            }

            // Hide/show navbar on scroll
            if (currentScroll > lastScroll && currentScroll > scrollThreshold) {
                navbar.classList.add('navbar-hidden');
            } else {
                navbar.classList.remove('navbar-hidden');
            }

            lastScroll = currentScroll;
        });

        // Mobile menu toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');

        mobileMenuBtn.addEventListener('click', () => {
            mobileMenuBtn.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenuBtn.classList.remove('active');
                mobileMenu.classList.remove('active');
            });
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation on scroll for feature cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 100);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s ease-out';
            observer.observe(card);
        });
    </script>