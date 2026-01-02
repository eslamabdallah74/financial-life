<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight bg-gradient-to-r from-gray-900 to-gray-600 bg-clip-text text-transparent">
                {{ __('Edit Transaction') }}
            </h2>
            <a href="{{ route('transactions.index') }}" 
               class="group inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 rounded-lg hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4 transform group-hover:rotate-90 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
                Close
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto">
        <form action="{{ route('transactions.update', $transaction) }}" method="POST" id="transaction-form" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Main Content -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8 sm:p-10">
                    
                    <!-- Transaction Type -->
                    <div class="mb-10">
                        <label class="block text-sm font-semibold text-gray-900 mb-4">Transaction Type</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer group">
                                <input type="radio" name="type" value="income" class="peer sr-only" 
                                       {{ old('type', $transaction->type) == 'income' ? 'checked' : '' }} required>
                                <div class="type-card relative h-28 rounded-2xl border-2 border-gray-200 bg-gradient-to-br from-green-50 to-emerald-50 
                                            flex flex-col items-center justify-center transition-all duration-200
                                            peer-checked:border-green-500 peer-checked:ring-4 peer-checked:ring-green-100 peer-checked:shadow-lg
                                            hover:border-green-300 hover:shadow-md">
                                    <div class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-opacity">
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <svg class="w-11 h-11 text-green-600 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    <span class="text-base font-bold text-green-700">Income</span>
                                </div>
                            </label>

                            <label class="cursor-pointer group">
                                <input type="radio" name="type" value="expense" class="peer sr-only" 
                                       {{ old('type', $transaction->type) == 'expense' ? 'checked' : '' }}>
                                <div class="type-card relative h-28 rounded-2xl border-2 border-gray-200 bg-gradient-to-br from-red-50 to-rose-50 
                                            flex flex-col items-center justify-center transition-all duration-200
                                            peer-checked:border-red-500 peer-checked:ring-4 peer-checked:ring-red-100 peer-checked:shadow-lg
                                            hover:border-red-300 hover:shadow-md">
                                    <div class="absolute top-3 right-3 opacity-0 peer-checked:opacity-100 transition-opacity">
                                        <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <svg class="w-11 h-11 text-red-600 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                                    </svg>
                                    <span class="text-base font-bold text-red-700">Expense</span>
                                </div>
                            </label>
                        </div>
                        @error('type')
                            <p class="mt-3 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Amount Input -->
                    <div class="mb-10">
                        <label for="amount" class="block text-sm font-semibold text-gray-900 mb-4">Amount</label>
                        <div class="relative group">
                            <div class="absolute left-6 top-1/2 -translate-y-1/2 text-4xl font-bold text-gray-400 pointer-events-none">$</div>
                            <input type="number" 
                                   id="amount" 
                                   name="amount" 
                                   step="0.01" 
                                   min="0" 
                                   placeholder="0.00"
                                   value="{{ old('amount', $transaction->amount) }}"
                                   class="w-full pl-20 pr-8 py-6 text-5xl font-extrabold border-2 border-gray-200 rounded-2xl 
                                          focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 
                                          transition-all placeholder:text-gray-300"
                                   required
                                   autofocus>
                            <div class="absolute right-6 top-6 text-sm font-medium text-gray-400">USD</div>
                        </div>
                        @error('amount')
                            <p class="mt-3 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent my-10"></div>

                    <!-- Category Selection -->
                    <div class="mb-10">
                        <div class="flex items-center justify-between mb-4">
                            <label class="text-sm font-semibold text-gray-900">Category</label>
                            <a href="{{ route('categories.create') }}" 
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                New Category
                            </a>
                        </div>
                        
                        <div class="grid grid-cols-4 sm:grid-cols-5 lg:grid-cols-6 gap-3">
                            @foreach($categories as $category)
                                <label class="cursor-pointer group">
                                    <input type="radio" 
                                           name="category_id" 
                                           value="{{ $category->id }}" 
                                           class="peer sr-only"
                                           {{ old('category_id', $transaction->category_id) == $category->id ? 'checked' : '' }}
                                           required>
                                    <div class="category-card relative h-24 rounded-2xl border-2 border-gray-200 bg-white 
                                                flex flex-col items-center justify-center transition-all duration-200
                                                peer-checked:border-indigo-500 peer-checked:ring-4 peer-checked:ring-indigo-100 peer-checked:shadow-md
                                                hover:border-gray-300 hover:shadow-sm group-hover:scale-[1.02]">
                                        <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity">
                                            <svg class="w-4 h-4 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        @if($category->icon)
                                            <span class="text-3xl mb-1.5 group-hover:scale-110 transition-transform">{{ $category->icon }}</span>
                                        @endif
                                        <span class="text-xs font-medium text-gray-700 text-center px-1.5 leading-tight">{{ $category->name }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        @error('category_id')
                            <p class="mt-3 text-sm text-red-600 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent my-10"></div>

                    <!-- Description and Date -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-semibold text-gray-900 mb-4">
                                Description
                                <span class="text-gray-400 font-normal text-xs">(Optional)</span>
                            </label>
                            <textarea 
                                id="description" 
                                name="description" 
                                rows="4"
                                placeholder="Add notes about this transaction..."
                                class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-2xl 
                                       focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 
                                       transition-all resize-none placeholder:text-gray-400"
                            >{{ old('description', $transaction->description) }}</textarea>
                            @error('description')
                                <p class="mt-3 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Date -->
                        <div>
                            <label for="transaction_date" class="block text-sm font-semibold text-gray-900 mb-4">Date</label>
                            <input type="date" 
                                   id="transaction_date" 
                                   name="transaction_date" 
                                   value="{{ old('transaction_date', $transaction->transaction_date) }}"
                                   class="w-full px-4 py-3.5 border-2 border-gray-200 rounded-2xl 
                                          focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 
                                          transition-all"
                                   required>
                            @error('transaction_date')
                                <p class="mt-3 text-sm text-red-600 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row items-center gap-4 pt-6 border-t border-gray-100">
                        <button type="submit" 
                                class="w-full sm:flex-1 btn-gradient py-4 text-base font-bold rounded-2xl
                                       flex items-center justify-center gap-2 shadow-lg hover:shadow-xl
                                       transform hover:scale-[1.02] transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Update Transaction
                        </button>
                        <a href="{{ route('transactions.index') }}" 
                           class="w-full sm:w-auto px-8 py-4 border-2 border-gray-200 rounded-2xl font-semibold text-gray-700 
                                  hover:bg-gray-50 hover:border-gray-300 transition-all text-center">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const amountInput = document.getElementById('amount');
            
            // Format amount on blur
            if (amountInput) {
                amountInput.addEventListener('blur', function() {
                    if (this.value) {
                        this.value = parseFloat(this.value).toFixed(2);
                    }
                });
            }

            // Form validation
            const form = document.getElementById('transaction-form');
            form.addEventListener('submit', function(e) {
                const categorySelected = document.querySelector('input[name="category_id"]:checked');
                const typeSelected = document.querySelector('input[name="type"]:checked');
                
                if (!categorySelected) {
                    e.preventDefault();
                    alert('Please select a category');
                    return;
                }
                
                if (!typeSelected) {
                    e.preventDefault();
                    alert('Please select a transaction type');
                    return;
                }
            });
        });
    </script>
    @endpush
</x-app-layout>