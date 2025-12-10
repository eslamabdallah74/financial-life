<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Transactions') }}
            </h2>
            <a href="{{ route('transactions.create') }}" class="btn-gradient inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('Add Transaction') }}
            </a>
        </div>
    </x-slot>

    <div class="fade-in">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <p class="text-green-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if($transactions->count() > 0)
            <!-- Transactions Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                @foreach($transactions as $transaction)
                    <div class="transaction-card {{ $transaction->type }}">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="icon-container {{ $transaction->type === 'income' ? 'success' : 'danger' }} !w-12 !h-12">
                                    @if($transaction->category && $transaction->category->icon)
                                        <span class="text-xl">{{ $transaction->category->icon }}</span>
                                    @else
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    @endif
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">
                                        {{ $transaction->category ? $transaction->category->name : 'Uncategorized' }}
                                    </h3>
                                    <p class="text-sm text-gray-500">
                                        {{ $transaction->transaction_date->format('M d, Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            @if($transaction->description)
                                <p class="text-sm text-gray-600 line-clamp-2">{{ $transaction->description }}</p>
                            @endif
                        </div>

                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <span class="category-badge {{ $transaction->type }}">
                                {{ ucfirst($transaction->type) }}
                            </span>
                            <span
                                class="text-xl font-bold {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $transaction->type === 'income' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
                            </span>
                        </div>

                        <!-- Actions (shown on hover) -->
                        <div class="flex gap-2 mt-3 pt-3 border-t border-gray-100">
                            <a href="{{ route('transactions.edit', $transaction) }}"
                                class="flex-1 text-center px-3 py-2 text-sm font-medium text-indigo-600 hover:text-indigo-700 hover:bg-indigo-50 rounded-md transition">
                                Edit
                            </a>
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="flex-1"
                                onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="w-full px-3 py-2 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-md transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $transactions->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-md p-12">
                <div class="text-center">
                    <div class="mx-auto h-24 w-24 mb-4">
                        <svg class="w-full h-full text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No transactions found</h3>
                    <p class="text-gray-500 mb-6">Get started by creating your first transaction!</p>
                    <a href="{{ route('transactions.create') }}" class="btn-gradient">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        {{ __('Add Transaction') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>