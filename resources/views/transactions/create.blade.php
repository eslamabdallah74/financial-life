<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-4xl font-black tracking-tight">
                    <span
                        class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                        Add Transaction
                    </span>
                </h2>
                <p class="mt-1 text-sm text-gray-500">Create a new income or expense entry</p>
            </div>
            <a href="{{ route('transactions.index') }}"
                class="group relative overflow-hidden px-5 py-2.5 bg-gray-900 text-white rounded-full font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                <span class="relative z-10 flex items-center gap-2">
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Close
                </span>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left">
                </div>
            </a>
        </div>
    </x-slot>

    <div class="relative max-w-6xl mx-auto">
        <!-- Decorative Background Elements -->
        <div
            class="absolute top-10 -left-10 w-72 h-72 bg-gradient-to-br from-indigo-400 to-purple-600 rounded-full opacity-10 blur-3xl">
        </div>
        <div
            class="absolute bottom-10 -right-10 w-96 h-96 bg-gradient-to-tr from-pink-400 to-orange-400 rounded-full opacity-10 blur-3xl">
        </div>

        <form action="{{ route('transactions.store') }}" method="POST" id="transaction-form" class="relative">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Form Column -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Transaction Type Card -->
                    <div
                        class="group relative bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-white shadow-xl hover:shadow-2xl transition-all duration-500">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        <div class="relative">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Transaction Type</h3>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative cursor-pointer group/type">
                                    <input type="radio" name="type" value="income" class="peer sr-only" {{ old('type') == 'income' ? 'checked' : '' }} required>
                                    <div
                                        class="relative h-32 rounded-2xl bg-gradient-to-br from-emerald-400 to-green-600 p-[2px] transition-all duration-300 peer-checked:scale-105 peer-checked:shadow-2xl peer-checked:shadow-green-500/50">
                                        <div
                                            class="h-full rounded-2xl bg-gradient-to-br from-emerald-50 to-green-50 p-6 flex flex-col items-center justify-center relative overflow-hidden">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent opacity-0 peer-checked:opacity-100 transition-opacity">
                                            </div>
                                            <svg class="w-14 h-14 text-green-600 mb-2 transform group-hover/type:scale-110 group-hover/type:rotate-6 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                            </svg>
                                            <span class="font-bold text-green-700 text-lg">Income</span>
                                            <div
                                                class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-all duration-300 scale-0 peer-checked:scale-100">
                                                <div
                                                    class="w-6 h-6 bg-green-600 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer group/type">
                                    <input type="radio" name="type" value="expense" class="peer sr-only" {{ old('type') == 'expense' ? 'checked' : '' }}>
                                    <div
                                        class="relative h-32 rounded-2xl bg-gradient-to-br from-rose-400 to-red-600 p-[2px] transition-all duration-300 peer-checked:scale-105 peer-checked:shadow-2xl peer-checked:shadow-red-500/50">
                                        <div
                                            class="h-full rounded-2xl bg-gradient-to-br from-rose-50 to-red-50 p-6 flex flex-col items-center justify-center relative overflow-hidden">
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent opacity-0 peer-checked:opacity-100 transition-opacity">
                                            </div>
                                            <svg class="w-14 h-14 text-red-600 mb-2 transform group-hover/type:scale-110 group-hover/type:-rotate-6 transition-transform"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                            </svg>
                                            <span class="font-bold text-red-700 text-lg">Expense</span>
                                            <div
                                                class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-all duration-300 scale-0 peer-checked:scale-100">
                                                <div
                                                    class="w-6 h-6 bg-red-600 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @error('type')
                                <p class="mt-3 text-sm text-red-600 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- AI Voice Recording Card -->
                    <div
                        class="group relative bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-white shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 via-purple-50/50 to-blue-50/50 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        </div>

                        <style>
                            @keyframes pulse-red {
                                0% {
                                    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.4);
                                }

                                70% {
                                    box-shadow: 0 0 0 15px rgba(239, 68, 68, 0);
                                }

                                100% {
                                    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
                                }
                            }

                            @keyframes pulse-indigo {
                                0% {
                                    box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4);
                                }

                                70% {
                                    box-shadow: 0 0 0 15px rgba(99, 102, 241, 0);
                                }

                                100% {
                                    box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
                                }
                            }

                            .recording-pulse {
                                animation: pulse-red 2s infinite;
                            }

                            .processing-pulse {
                                animation: pulse-indigo 2s infinite;
                            }

                            .shimmer {
                                background-image: linear-gradient(90deg,
                                        rgba(255, 255, 255, 0) 0%,
                                        rgba(255, 255, 255, 0.1) 50%,
                                        rgba(255, 255, 255, 0) 100%);
                                background-size: 200% 100%;
                                animation: shimmer 2s infinite linear;
                            }

                            .aurora-animate {
                                background-size: 400% 400%;
                                animation: aurora 15s ease infinite;
                            }

                            @keyframes aurora {
                                0% {
                                    background-position: 0% 50%;
                                }

                                50% {
                                    background-position: 100% 50%;
                                }

                                100% {
                                    background-position: 0% 50%;
                                }
                            }

                            @keyframes shimmer {
                                0% {
                                    background-position: -200% 0;
                                }

                                100% {
                                    background-position: 200% 0;
                                }
                            }

                            .voice-wave {
                                display: flex;
                                align-items: center;
                                gap: 3px;
                                height: 24px;
                            }

                            .wave-bar {
                                width: 3px;
                                height: 100%;
                                background-color: white;
                                border-radius: 10px;
                                animation: wave 1.2s infinite ease-in-out;
                            }

                            .wave-bar:nth-child(2) {
                                animation-delay: 0.1s;
                            }

                            .wave-bar:nth-child(3) {
                                animation-delay: 0.2s;
                            }

                            .wave-bar:nth-child(4) {
                                animation-delay: 0.3s;
                            }

                            .wave-bar:nth-child(5) {
                                animation-delay: 0.4s;
                            }

                            @keyframes wave {

                                0%,
                                100% {
                                    transform: scaleY(0.3);
                                }

                                50% {
                                    transform: scaleY(1);
                                }

                            /* Remove number input arrows/scroll */
                            input::-webkit-outer-spin-button,
                            input::-webkit-inner-spin-button {
                                -webkit-appearance: none;
                                margin: 0;
                            }
                            input[type=number] {
                                -moz-appearance: textfield;
                            }
                        </style>                        <div class="relative">
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center gap-4">
                                    <div
                                        class="p-3 bg-gradient-to-br from-indigo-500 via-purple-600 to-pink-600 rounded-2xl shadow-xl transform group-hover:rotate-6 transition-transform duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-black text-gray-900 tracking-tight">AI Voice Assistant
                                        </h3>
                                        <p class="text-sm font-medium text-gray-500">Record your transaction naturally
                                        </p>
                                    </div>
                                </div>
                                <div id="ai-confidence-badge"
                                    class="hidden transform scale-0 animate-in fade-in zoom-in duration-500 translate-x-0">
                                    <div
                                        class="flex items-center gap-2 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-full border border-emerald-100 shadow-sm">
                                        <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></div>
                                        <span class="text-xs font-bold whitespace-nowrap"><span
                                                id="confidence-score">95</span>% accuracy</span>
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                <div class="md:col-span-12">
                                    <!-- Dynamic Action Button -->
                                    <button type="button" id="voice-record-btn"
                                        class="group/btn relative w-full h-24 rounded-3xl overflow-hidden transition-all duration-500 transform hover:scale-[1.01] active:scale-[0.99] shadow-lg hover:shadow-2xl">
                                        <!-- Idle State -->
                                        <div id="btn-content-idle"
                                            class="absolute inset-0 flex items-center justify-center gap-4 bg-gray-900 group-hover/btn:bg-black transition-colors duration-300">
                                            <div
                                                class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center group-hover/btn:scale-110 transition-transform">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2.5"
                                                        d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                <div class="text-white font-black text-xl tracking-tight">Tap to record
                                                </div>
                                                <div class="text-gray-400 text-xs font-bold uppercase tracking-widest">
                                                    System Ready</div>
                                            </div>
                                        </div>

                                        <!-- Recording State -->
                                        <div id="btn-content-recording"
                                            class="hidden absolute inset-0 flex items-center justify-center gap-4 bg-rose-600 recording-pulse">
                                            <div
                                                class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                                <div class="w-4 h-4 bg-white rounded-sm animate-pulse"></div>
                                            </div>
                                            <div class="text-left">
                                                <div class="text-white font-black text-xl tracking-tight">Recording...
                                                    <span id="recording-timer" class="font-mono ml-2">0:00</span>
                                                </div>
                                                <div
                                                    class="text-rose-100 text-xs font-bold uppercase tracking-widest animate-pulse">
                                                    Tap to stop</div>
                                            </div>
                                        </div>

                                        <!-- Processing State -->
                                        <div id="btn-content-processing"
                                            class="hidden absolute inset-0 flex items-center justify-center bg-gradient-to-br from-indigo-600 via-violet-600 to-fuchsia-600">

                                            <div
                                                class="flex items-center gap-6 px-8 py-6 rounded-2xl bg-white/10 backdrop-blur-md shadow-2xl">

                                                <div class="flex items-end gap-1 h-10">
                                                    <span class="w-1.5 rounded-full bg-white/90 animate-pulse"
                                                        style="height: 12px"></span>
                                                    <span class="w-1.5 rounded-full bg-white/90 animate-pulse"
                                                        style="height: 20px; animation-delay:.1s"></span>
                                                    <span class="w-1.5 rounded-full bg-white/90 animate-pulse"
                                                        style="height: 28px; animation-delay:.2s"></span>
                                                    <span class="w-1.5 rounded-full bg-white/90 animate-pulse"
                                                        style="height: 20px; animation-delay:.3s"></span>
                                                    <span class="w-1.5 rounded-full bg-white/90 animate-pulse"
                                                        style="height: 12px; animation-delay:.4s"></span>
                                                </div>

                                                <div class="text-left">
                                                    <div class="text-lg font-semibold text-white tracking-tight">
                                                        Analyzing details
                                                    </div>
                                                    <div class="flex items-center gap-2 mt-1">
                                                        <span
                                                            class="w-1.5 h-1.5 rounded-full bg-emerald-300 animate-ping"></span>
                                                        <span
                                                            class="text-[11px] uppercase tracking-widest text-white/80">
                                                            Gemini Engine
                                                        </span>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </button>
                                </div>

                                <!-- Guidelines -->
                                <div class="md:col-span-12 grid grid-cols-1 sm:grid-cols-2 gap-4 mt-2">
                                    <div
                                        class="p-5 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl border border-indigo-100/50 hover:border-indigo-300 transition-colors group/guide">
                                        <div class="flex items-center gap-3 mb-2">
                                            <div
                                                class="p-1.5 bg-indigo-100 rounded-lg text-indigo-600 group-hover/guide:scale-110 transition-transform">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                                                </svg>
                                            </div>
                                            <span
                                                class="text-xs font-black text-indigo-900 uppercase tracking-widest">Example
                                                1</span>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 italic">"Sent $250 to Sarah for rent
                                            yesterday"</p>
                                    </div>
                                    <div
                                        class="p-5 bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl border border-pink-100/50 hover:border-pink-300 transition-colors group/guide">
                                        <div class="flex items-center gap-3 mb-2">
                                            <div
                                                class="p-1.5 bg-pink-100 rounded-lg text-pink-600 group-hover/guide:scale-110 transition-transform">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path
                                                        d="M10 2a8 8 0 100 16 8 8 0 000-16zM11 11V7h-2v4H7l3 3 3-3h-2z" />
                                                </svg>
                                            </div>
                                            <span
                                                class="text-xs font-black text-pink-900 uppercase tracking-widest">Example
                                                2</span>
                                        </div>
                                        <p class="text-sm font-medium text-gray-700 italic">"Salary deposit of $3200
                                            received"</p>
                                    </div>
                                </div>

                                <!-- Status Indicators -->
                                <div id="voice-status-message"
                                    class="hidden md:col-span-12 p-5 rounded-2xl border transition-all duration-500 animate-in slide-in-from-top-4">
                                    <div class="flex items-center gap-4">
                                        <div id="status-icon" class="p-2 rounded-xl"></div>
                                        <div class="flex-1">
                                            <p class="text-sm font-black tracking-tight" id="status-text"></p>
                                            <p class="text-xs opacity-70 mt-0.5" id="status-details"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Amount Card -->
                    <div
                        class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-3xl p-[2px] shadow-2xl shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-shadow duration-500">
                        <div class="bg-white rounded-3xl p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Amount</h3>
                            </div>

                            <div class="relative group">
                                <input type="number" id="amount" name="amount" step="0.01" min="0" placeholder="0.00"
                                    value="{{ old('amount') }}"
                                    class="w-full pl-24 pr-20 py-8 text-6xl font-black border-0 bg-gradient-to-r from-gray-50 to-indigo-50 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-300 transition-all placeholder:text-gray-300"
                                    required>
                                <div class="absolute right-6 top-1/2 -translate-y-1/2">
                                    <span
                                        class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-sm font-bold rounded-full shadow-lg">{{ app(App\Services\CurrencyService::class)->getCurrencyCode() }}</span>
                                </div>
                            </div>
                            @error('amount')
                                <p class="mt-3 text-sm text-red-600 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Categories Card -->
                    <div class="relative bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-white shadow-xl">
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-center gap-3">
                                <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Category</h3>
                            </div>
                            <a href="{{ route('categories.create') }}"
                                class="group inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full font-semibold shadow-lg hover:shadow-xl transition-all hover:scale-105">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                New
                            </a>
                        </div>

                        <div class="grid grid-cols-4 sm:grid-cols-5 gap-3">
                            @foreach($categories as $category)
                                <label class="cursor-pointer group/cat">
                                    <input type="radio" name="category_id" value="{{ $category->id }}" class="peer sr-only"
                                        {{ old('category_id') == $category->id ? 'checked' : '' }} required>
                                    <div
                                        class="relative h-24 rounded-2xl bg-white border-2 border-gray-200 flex flex-col items-center justify-center transition-all duration-300 peer-checked:border-indigo-500 peer-checked:shadow-xl peer-checked:shadow-indigo-200 peer-checked:-translate-y-1 hover:border-indigo-300 hover:-translate-y-0.5 hover:shadow-lg">
                                        @if($category->icon)
                                            <span
                                                class="text-3xl mb-1 transform group-hover/cat:scale-125 transition-transform duration-300">{{ $category->icon }}</span>
                                        @endif
                                        <span class="text-xs font-semibold text-gray-700">{{ $category->name }}</span>
                                        <div
                                            class="absolute -top-2 -right-2 opacity-0 peer-checked:opacity-100 scale-0 peer-checked:scale-100 transition-all duration-300">
                                            <div
                                                class="w-6 h-6 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                                <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('category_id')
                            <p class="mt-3 text-sm text-red-600 flex items-center gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Details Card -->
                    <div class="relative bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-white shadow-xl">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Details</h3>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label for="description" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Description <span class="text-gray-400 font-normal">(optional)</span>
                                </label>
                                <textarea id="description" name="description" rows="3"
                                    placeholder="Add notes about this transaction..."
                                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all resize-none placeholder:text-gray-400">{{ old('description') }}</textarea>
                            </div>

                            <div>
                                <label for="transaction_date"
                                    class="block text-sm font-semibold text-gray-700 mb-3">Date</label>
                                <input type="date" id="transaction_date" name="transaction_date"
                                    value="{{ old('transaction_date', date('Y-m-d')) }}"
                                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all"
                                    required>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button type="submit"
                            class="flex-1 group relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 text-white font-bold py-5 rounded-2xl shadow-2xl shadow-indigo-500/50 hover:shadow-indigo-500/70 transform hover:scale-[1.02] transition-all duration-300">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Create Transaction
                            </span>
                            <div
                                class="absolute inset-0 bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            </div>
                        </button>
                        <a href="{{ route('transactions.index') }}"
                            class="px-8 py-5 border-2 border-gray-300 rounded-2xl font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-400 transition-all">
                            Cancel
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-6 space-y-6">


                        <!-- Tips Card -->
                        <div
                            class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-3xl p-6 border border-indigo-100">
                            <div class="flex items-start gap-3">
                                <div
                                    class="flex-shrink-0 w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-indigo-900 mb-2">Quick Tips</h4>
                                    <ul class="text-sm text-indigo-700 space-y-1.5">
                                        <li>• Tab to navigate fields</li>
                                        <li>• Auto-formats to 2 decimals</li>
                                        <li>• Enter to submit</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const amountInput = document.getElementById('amount');




                // Format amount
                amountInput?.addEventListener('blur', function () {
                    if (this.value) {
                        this.value = parseFloat(this.value).toFixed(2);
                    }
                });

                // ==================== VOICE RECORDING FUNCTIONALITY ====================
                const recordBtn = document.getElementById('voice-record-btn');
                const btnIdle = document.getElementById('btn-content-idle');
                const btnRecording = document.getElementById('btn-content-recording');
                const btnProcessing = document.getElementById('btn-content-processing');
                const recordingTimer = document.getElementById('recording-timer');
                const statusMessage = document.getElementById('voice-status-message');
                const statusText = document.getElementById('status-text');
                const statusDetails = document.getElementById('status-details');
                const statusIcon = document.getElementById('status-icon');
                const confidenceBadge = document.getElementById('ai-confidence-badge');
                const confidenceScore = document.getElementById('confidence-score');
                const transactionForm = document.getElementById('transaction-form');

                let mediaRecorder = null;
                let audioChunks = [];
                let recordingStartTime = null;
                let timerInterval = null;

                // Set button states and form locking
                function setFormLock(locked) {
                    const inputs = transactionForm.querySelectorAll('input, textarea, select, button[type="submit"]');
                    inputs.forEach(input => {
                        if (input.id !== 'voice-record-btn') {
                            input.disabled = locked;
                            input.style.opacity = locked ? '0.5' : '1';
                            input.style.pointerEvents = locked ? 'none' : 'auto';
                        }
                    });
                }

                function setButtonState(state) {
                    btnIdle.classList.add('hidden');
                    btnRecording.classList.add('hidden');
                    btnProcessing.classList.add('hidden');

                    if (state === 'idle') {
                        btnIdle.classList.remove('hidden');
                        recordBtn.disabled = false;
                        setFormLock(false);
                    } else if (state === 'recording') {
                        btnRecording.classList.remove('hidden');
                        recordBtn.disabled = false;
                        setFormLock(true);
                    } else if (state === 'processing') {
                        btnProcessing.classList.remove('hidden');
                        recordBtn.style.pointerEvents = 'none';
                        setFormLock(true);
                    }
                }

                // Show status message with professional icons
                function showStatus(message, type = 'info', details = '') {
                    statusText.textContent = message;
                    statusDetails.textContent = details;
                    statusMessage.classList.remove('hidden', 'bg-red-50', 'bg-emerald-50', 'bg-indigo-50', 'border-red-200', 'border-emerald-200', 'border-indigo-200');
                    statusIcon.innerHTML = '';
                    statusText.classList.remove('text-red-900', 'text-emerald-900', 'text-indigo-900');
                    statusIcon.className = 'p-2 rounded-xl';

                    let iconHtml = '';
                    if (type === 'error') {
                        statusMessage.classList.add('bg-red-50', 'border-red-200');
                        statusText.classList.add('text-red-900');
                        statusIcon.classList.add('bg-red-100', 'text-red-600');
                        iconHtml = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>';
                    } else if (type === 'success') {
                        statusMessage.classList.add('bg-emerald-50', 'border-emerald-200');
                        statusText.classList.add('text-emerald-900');
                        statusIcon.classList.add('bg-emerald-100', 'text-emerald-600');
                        iconHtml = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>';
                    } else {
                        statusMessage.classList.add('bg-indigo-50', 'border-indigo-200');
                        statusText.classList.add('text-indigo-900');
                        statusIcon.classList.add('bg-indigo-100', 'text-indigo-600');
                        iconHtml = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>';
                    }

                    statusIcon.innerHTML = iconHtml;
                    statusMessage.classList.remove('hidden');
                }

                function hideStatus() {
                    statusMessage.classList.add('hidden');
                }

                function updateTimer() {
                    if (!recordingStartTime) return;
                    const elapsed = Math.floor((Date.now() - recordingStartTime) / 1000);
                    const minutes = Math.floor(elapsed / 60);
                    const seconds = elapsed % 60;
                    recordingTimer.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                }

                async function startRecording() {
                    try {
                        hideStatus();
                        confidenceBadge.classList.add('hidden');
                        confidenceBadge.classList.remove('scale-100');
                        confidenceBadge.classList.add('scale-0');

                        const stream = await navigator.mediaDevices.getUserMedia({ audio: true });

                        mediaRecorder = new MediaRecorder(stream, {
                            mimeType: MediaRecorder.isTypeSupported('audio/webm') ? 'audio/webm' : 'audio/mp4'
                        });

                        audioChunks = [];

                        mediaRecorder.addEventListener('dataavailable', event => {
                            audioChunks.push(event.data);
                        });

                        mediaRecorder.addEventListener('stop', async () => {
                            const audioBlob = new Blob(audioChunks, { type: mediaRecorder.mimeType });
                            stream.getTracks().forEach(track => track.stop());
                            await processAudio(audioBlob);
                        });

                        mediaRecorder.start();
                        recordingStartTime = Date.now();
                        setButtonState('recording');

                        timerInterval = setInterval(updateTimer, 1000);

                    } catch (error) {
                        console.error('Error starting recording:', error);
                        showStatus('Microphone Access Denied', 'error', 'Please enable microphone permissions in your browser settings to use voice input.');
                        setButtonState('idle');
                    }
                }

                function stopRecording() {
                    if (mediaRecorder && mediaRecorder.state === 'recording') {
                        mediaRecorder.stop();
                        clearInterval(timerInterval);
                        setButtonState('processing');
                    }
                }

                async function processAudio(audioBlob) {
                    try {
                        const formData = new FormData();
                        formData.append('audio', audioBlob, 'recording.webm');

                        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                        const response = await fetch('{{ route("transactions.process-voice") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: formData
                        });

                        const result = await response.json();

                        if (result.success && result.data) {
                            populateForm(result.data);
                            showStatus('Voice Processing Complete', 'success', 'Gemini AI successfully extracted your transaction details. Please review them below.');

                            if (result.data.ai_confidence_score) {
                                confidenceScore.textContent = result.data.ai_confidence_score;
                                confidenceBadge.classList.remove('hidden', 'scale-0');
                                confidenceBadge.classList.add('scale-100');
                            }
                        } else {
                            showStatus('AI Recognition Failed', 'error', result.message || 'We could not understand the transaction. Please try speaking clearer.');
                        }

                    } catch (error) {
                        console.error('Error processing audio:', error);
                        showStatus('Connection Interrupted', 'error', 'There was a problem communicating with the AI engine. Please check your internet connection.');
                    } finally {
                        setButtonState('idle');
                    }
                }

                // Populate form with AI-extracted data
                function populateForm(data) {
                    // Set transaction type
                    if (data.type) {
                        const typeRadio = document.querySelector(`input[name="type"][value="${data.type}"]`);
                        if (typeRadio) {
                            typeRadio.checked = true;
                            typeRadio.dispatchEvent(new Event('change'));
                        }
                    }

                    // Set amount
                    if (data.amount && amountInput) {
                        amountInput.value = parseFloat(data.amount).toFixed(2);
                        amountInput.dispatchEvent(new Event('input'));
                        amountInput.dispatchEvent(new Event('blur'));
                    }

                    // Set category
                    if (data.category_id) {
                        const categoryRadio = document.querySelector(`input[name="category_id"][value="${data.category_id}"]`);
                        if (categoryRadio) {
                            categoryRadio.checked = true;
                        }
                    }

                    // Set description
                    const descriptionField = document.getElementById('description');
                    if (data.description && descriptionField) {
                        descriptionField.value = data.description;
                    }

                    // Set transaction date
                    const dateField = document.getElementById('transaction_date');
                    if (data.transaction_date && dateField) {
                        dateField.value = data.transaction_date;
                    }

                    // Smooth scroll to amount field for user to review
                    // scroll removed as requested
                }

                // Record button click handler
                recordBtn?.addEventListener('click', function () {
                    if (mediaRecorder && mediaRecorder.state === 'recording') {
                        stopRecording();
                    } else {
                        startRecording();
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>