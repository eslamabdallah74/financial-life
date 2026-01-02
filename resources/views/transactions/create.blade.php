<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-4xl font-black tracking-tight">
                    <span class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                        Add Transaction
                    </span>
                </h2>
                <p class="mt-1 text-sm text-gray-500">Create a new income or expense entry</p>
            </div>
            <a href="{{ route('transactions.index') }}" 
               class="group relative overflow-hidden px-5 py-2.5 bg-gray-900 text-white rounded-full font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                <span class="relative z-10 flex items-center gap-2">
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Close
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
            </a>
        </div>
    </x-slot>

    <div class="relative max-w-6xl mx-auto">
        <!-- Decorative Background Elements -->
        <div class="absolute top-10 -left-10 w-72 h-72 bg-gradient-to-br from-indigo-400 to-purple-600 rounded-full opacity-10 blur-3xl"></div>
        <div class="absolute bottom-10 -right-10 w-96 h-96 bg-gradient-to-tr from-pink-400 to-orange-400 rounded-full opacity-10 blur-3xl"></div>

        <form action="{{ route('transactions.store') }}" method="POST" id="transaction-form" class="relative">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Form Column -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Transaction Type Card -->
                    <div class="group relative bg-white/80 backdrop-blur-xl rounded-3xl p-8 border border-white shadow-xl hover:shadow-2xl transition-all duration-500">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        
                        <div class="relative">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Transaction Type</h3>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <label class="relative cursor-pointer group/type">
                                    <input type="radio" name="type" value="income" class="peer sr-only" {{ old('type') == 'income' ? 'checked' : '' }} required>
                                    <div class="relative h-32 rounded-2xl bg-gradient-to-br from-emerald-400 to-green-600 p-[2px] transition-all duration-300 peer-checked:scale-105 peer-checked:shadow-2xl peer-checked:shadow-green-500/50">
                                        <div class="h-full rounded-2xl bg-gradient-to-br from-emerald-50 to-green-50 p-6 flex flex-col items-center justify-center relative overflow-hidden">
                                            <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                            <svg class="w-14 h-14 text-green-600 mb-2 transform group-hover/type:scale-110 group-hover/type:rotate-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                            </svg>
                                            <span class="font-bold text-green-700 text-lg">Income</span>
                                            <div class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-all duration-300 scale-0 peer-checked:scale-100">
                                                <div class="w-6 h-6 bg-green-600 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="relative cursor-pointer group/type">
                                    <input type="radio" name="type" value="expense" class="peer sr-only" {{ old('type') == 'expense' ? 'checked' : '' }}>
                                    <div class="relative h-32 rounded-2xl bg-gradient-to-br from-rose-400 to-red-600 p-[2px] transition-all duration-300 peer-checked:scale-105 peer-checked:shadow-2xl peer-checked:shadow-red-500/50">
                                        <div class="h-full rounded-2xl bg-gradient-to-br from-rose-50 to-red-50 p-6 flex flex-col items-center justify-center relative overflow-hidden">
                                            <div class="absolute inset-0 bg-gradient-to-br from-white/50 to-transparent opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                                            <svg class="w-14 h-14 text-red-600 mb-2 transform group-hover/type:scale-110 group-hover/type:-rotate-6 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                            </svg>
                                            <span class="font-bold text-red-700 text-lg">Expense</span>
                                            <div class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-all duration-300 scale-0 peer-checked:scale-100">
                                                <div class="w-6 h-6 bg-red-600 rounded-full flex items-center justify-center">
                                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
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
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Amount Card -->
                    <div class="relative bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600 rounded-3xl p-[2px] shadow-2xl shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-shadow duration-500">
                        <div class="bg-white rounded-3xl p-8">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="p-2 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Amount</h3>
                            </div>
                            
                            <div class="relative group">
                                <div class="absolute left-6 top-1/2 -translate-y-1/2 text-5xl font-black bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent pointer-events-none">$</div>
                                <input type="number" 
                                       id="amount" 
                                       name="amount" 
                                       step="0.01" 
                                       min="0" 
                                       placeholder="0.00"
                                       value="{{ old('amount') }}"
                                       class="w-full pl-24 pr-20 py-8 text-6xl font-black border-0 bg-gradient-to-r from-gray-50 to-indigo-50 rounded-2xl focus:outline-none focus:ring-4 focus:ring-indigo-300 transition-all placeholder:text-gray-300"
                                       required
                                       autofocus>
                                <div class="absolute right-6 top-1/2 -translate-y-1/2">
                                    <span class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-sm font-bold rounded-full shadow-lg">USD</span>
                                </div>
                            </div>
                            @error('amount')
                                <p class="mt-3 text-sm text-red-600 flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
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
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Category</h3>
                            </div>
                            <a href="{{ route('categories.create') }}" 
                               class="group inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-full font-semibold shadow-lg hover:shadow-xl transition-all hover:scale-105">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                New
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-4 sm:grid-cols-5 gap-3">
                            @foreach($categories as $category)
                                <label class="cursor-pointer group/cat">
                                    <input type="radio" 
                                           name="category_id" 
                                           value="{{ $category->id }}" 
                                           class="peer sr-only"
                                           {{ old('category_id') == $category->id ? 'checked' : '' }}
                                           required>
                                    <div class="relative h-24 rounded-2xl bg-white border-2 border-gray-200 flex flex-col items-center justify-center transition-all duration-300 peer-checked:border-indigo-500 peer-checked:shadow-xl peer-checked:shadow-indigo-200 peer-checked:-translate-y-1 hover:border-indigo-300 hover:-translate-y-0.5 hover:shadow-lg">
                                        @if($category->icon)
                                            <span class="text-3xl mb-1 transform group-hover/cat:scale-125 transition-transform duration-300">{{ $category->icon }}</span>
                                        @endif
                                        <span class="text-xs font-semibold text-gray-700">{{ $category->name }}</span>
                                        <div class="absolute -top-2 -right-2 opacity-0 peer-checked:opacity-100 scale-0 peer-checked:scale-100 transition-all duration-300">
                                            <div class="w-6 h-6 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center shadow-lg">
                                                <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
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
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Details</h3>
                        </div>
                        
                        <div class="space-y-6">
                            <div>
                                <label for="description" class="block text-sm font-semibold text-gray-700 mb-3">
                                    Description <span class="text-gray-400 font-normal">(optional)</span>
                                </label>
                                <textarea 
                                    id="description" 
                                    name="description" 
                                    rows="3"
                                    placeholder="Add notes about this transaction..."
                                    class="w-full px-5 py-4 border-2 border-gray-200 rounded-2xl focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all resize-none placeholder:text-gray-400"
                                >{{ old('description') }}</textarea>
                            </div>

                            <div>
                                <label for="transaction_date" class="block text-sm font-semibold text-gray-700 mb-3">Date</label>
                                <input type="date" 
                                       id="transaction_date" 
                                       name="transaction_date" 
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                                </svg>
                                Create Transaction
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-pink-600 via-purple-600 to-indigo-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
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
                        <!-- Preview Card -->
                        <div class="relative bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl p-6 text-white shadow-2xl overflow-hidden">
                            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full opacity-20 blur-3xl"></div>
                            <div class="relative">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="text-sm font-medium text-gray-400">Preview</span>
                                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                </div>
                                <div class="text-4xl font-black mb-2" id="preview-amount">$0.00</div>
                                <div class="text-sm text-gray-400" id="preview-type">Select type</div>
                            </div>
                        </div>

                        <!-- Tips Card -->
                        <div class="bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 rounded-3xl p-6 border border-indigo-100">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
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
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('amount');
            const previewAmount = document.getElementById('preview-amount');
            const previewType = document.getElementById('preview-type');
            
            // Update preview
            amountInput?.addEventListener('input', function() {
                const val = parseFloat(this.value) || 0;
                previewAmount.textContent = '$' + val.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
            });

            // Format amount
            amountInput?.addEventListener('blur', function() {
                if (this.value) {
                    this.value = parseFloat(this.value).toFixed(2);
                    previewAmount.textContent = '$' + parseFloat(this.value).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
                }
            });

            // Update type preview
            document.querySelectorAll('input[name="type"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    previewType.textContent = this.value.charAt(0).toUpperCase() + this.value.slice(1);
                });
            });

            // Auto-focus
            amountInput?.focus();
        });
    </script>
    @endpush
</x-app-layout>
