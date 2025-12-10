<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Edit Transaction') }}
            </h2>
            <a href="{{ route('transactions.index') }}" 
               class="text-gray-600 hover:text-gray-900 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto fade-in">
        <form action="{{ route('transactions.update', $transaction) }}" method="POST" id="transaction-form">
            @csrf
            @method('PATCH')

            <!-- Main Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="p-8">
                    <!-- Transaction Type Toggle -->
                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Transaction Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="income" 
                                       class="peer sr-only" 
                                       {{ old('type', $transaction->type) == 'income' ? 'checked' : '' }}
                                       required>
                                <div class="h-24 rounded-xl border-2 border-gray-200 bg-gradient-to-br from-green-50 to-emerald-50 flex flex-col items-center justify-center transition-all peer-checked:border-green-500 peer-checked:shadow-lg peer-checked:scale-105 peer-checked:from-green-100 peer-checked:to-emerald-100 hover:border-green-300">
                                    <svg class="w-10 h-10 text-green-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    <span class="text-sm font-bold text-green-700">Income</span>
                                </div>
                            </label>

                            <label class="relative cursor-pointer">
                                <input type="radio" name="type" value="expense" 
                                       class="peer sr-only" 
                                       {{ old('type', $transaction->type) == 'expense' ? 'checked' : '' }}>
                                <div class="h-24 rounded-xl border-2 border-gray-200 bg-gradient-to-br from-red-50 to-rose-50 flex flex-col items-center justify-center transition-all peer-checked:border-red-500 peer-checked:shadow-lg peer-checked:scale-105 peer-checked:from-red-100 peer-checked:to-rose-100 hover:border-red-300">
                                    <svg class="w-10 h-10 text-red-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                    </svg>
                                    <span class="text-sm font-bold text-red-700">Expense</span>
                                </div>
                            </label>
                        </div>
                        @error('type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount Input (Large & Prominent) -->
                    <div class="mb-8">
                        <label for="amount" class="block text-sm font-semibold text-gray-700 mb-3">Amount</label>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-3xl font-bold text-gray-400">$</span>
                            <input type="number" 
                                   id="amount" 
                                   name="amount" 
                                   step="0.01" 
                                   min="0" 
                                   placeholder="0.00"
                                   value="{{ old('amount', $transaction->amount) }}"
                                   class="w-full pl-14 pr-6 py-5 text-4xl font-bold border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none"
                                   required
                                   autofocus>
                        </div>
                        @error('amount')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Selection (Visual Grid) -->
                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Category</label>
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                            @foreach($categories as $category)
                                <label class="relative cursor-pointer">
                                    <input type="radio" 
                                           name="category_id" 
                                           value="{{ $category->id }}" 
                                           class="peer sr-only"
                                           {{ old('category_id', $transaction->category_id) == $category->id ? 'checked' : '' }}
                                           required>
                                    <div class="h-20 rounded-xl border-2 border-gray-200 bg-white flex flex-col items-center justify-center transition-all peer-checked:border-indigo-500 peer-checked:shadow-md peer-checked:scale-105 hover:border-gray-300 hover:shadow-sm group">
                                        @if($category->icon)
                                            <span class="text-3xl mb-1 group-hover:scale-110 transition">{{ $category->icon }}</span>
                                        @endif
                                        <span class="text-xs font-medium text-gray-700 text-center px-1 leading-tight">{{ $category->name }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-8">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-3">
                            Description
                            <span class="text-gray-400 font-normal">(Optional)</span>
                        </label>
                        <textarea 
                            id="description" 
                            name="description" 
                            rows="3"
                            placeholder="Add notes about this transaction..."
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none resize-none"
                        >{{ old('description', $transaction->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="mb-8">
                        <label for="transaction_date" class="block text-sm font-semibold text-gray-700 mb-3">Date</label>
                        <input type="date" 
                               id="transaction_date" 
                               name="transaction_date" 
                               value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 transition-all outline-none"
                               required>
                        @error('transaction_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                        <button type="submit" 
                                class="btn-gradient flex-1 py-4 text-base font-bold flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Transaction
                        </button>
                        <a href="{{ route('transactions.index') }}" 
                           class="px-6 py-4 border-2 border-gray-200 rounded-xl font-semibold text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition-all">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // Focus amount input on load
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('amount');
            if (amountInput) {
                amountInput.focus();
            }

            // Format amount on blur
            amountInput.addEventListener('blur', function() {
                if (this.value) {
                    this.value = parseFloat(this.value).toFixed(2);
                }
            });
        });
    </script>
    @endpush
</x-app-layout>