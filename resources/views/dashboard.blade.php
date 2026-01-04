<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
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
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Balance Card -->
            <x-stat-card title="Total Balance" :value="@money($totalBalance)" subtitle="Current balance"
                icon-variant="primary">
                <x-slot name="icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </x-slot>
            </x-stat-card>

            <!-- Monthly Income Card -->
            <x-stat-card title="Monthly Income" :value="@money($monthlyIncome)" subtitle="This month" variant="success"
                value-class="text-green-600" icon-variant="success">
                <x-slot name="icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                </x-slot>
            </x-stat-card>

            <!-- Monthly Expenses Card -->
            <x-stat-card title="Monthly Expenses" :value="@money($monthlyExpenses)" subtitle="This month"
                variant="danger" value-class="text-red-600" icon-variant="danger">
                <x-slot name="icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                    </svg>
                </x-slot>
            </x-stat-card>

            <!-- Savings Rate Card -->
            <x-stat-card title="Savings Rate" :value="$savingsRate . '%'" subtitle="Of income" variant="info"
                value-class="text-blue-600" icon-variant="info">
                <x-slot name="icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </x-slot>
            </x-stat-card>
        </div>

        <!-- Recent Transactions & Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Recent Transactions -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-gray-800">Recent Transactions</h3>
                        <a href="{{ route('transactions.index') }}"
                            class="text-sm font-medium text-indigo-600 hover:text-indigo-700">
                            View All →
                        </a>
                    </div>
                    <div class="p-6">
                        @if($recentTransactions->count() > 0)
                            <div class="space-y-3">
                                @foreach($recentTransactions as $transaction)
                                    <x-transaction-item :transaction="$transaction" />
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No transactions</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by creating a new transaction.</p>
                                <div class="mt-6">
                                    <a href="{{ route('transactions.create') }}" class="btn-gradient">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                        Add Transaction
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div>
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800">Quick Actions</h3>
                    </div>
                    <div class="p-6 space-y-3">
                        <a href="{{ route('transactions.create') }}"
                            class="block p-4 rounded-lg border-2 border-gray-200 hover:border-indigo-500 hover:bg-indigo-50 transition group">
                            <div class="flex items-center gap-3">
                                <div class="icon-container primary group-hover:scale-110 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">Add Transaction</p>
                                    <p class="text-xs text-gray-500">Record income or expense</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('categories.create') }}"
                            class="block p-4 rounded-lg border-2 border-gray-200 hover:border-indigo-500 hover:bg-indigo-50 transition group">
                            <div class="flex items-center gap-3">
                                <div class="icon-container primary group-hover:scale-110 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">New Category</p>
                                    <p class="text-xs text-gray-500">Organize your finances</p>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('transactions.index') }}"
                            class="block p-4 rounded-lg border-2 border-gray-200 hover:border-indigo-500 hover:bg-indigo-50 transition group">
                            <div class="flex items-center gap-3">
                                <div class="icon-container info group-hover:scale-110 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900">View All</p>
                                    <p class="text-xs text-gray-500">See all transactions</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Monthly Summary -->
                <div
                    class="mt-6 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-md overflow-hidden p-6 text-white">
                    <h3 class="text-lg font-semibold mb-4">Monthly Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm opacity-90">Income</span>
                            <span class="font-bold">@money($monthlyIncome)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm opacity-90">Expenses</span>
                            <span class="font-bold">@money($monthlyExpenses)</span>
                        </div>
                        <div class="border-t border-white border-opacity-20 pt-3 flex justify-between items-center">
                            <span class="font-semibold">Net</span>
                            <span
                                class="text-xl font-bold">@money($monthlyIncome - $monthlyExpenses)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>