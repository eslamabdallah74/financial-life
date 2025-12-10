@props(['transaction'])

<div class="flex items-center justify-between p-3 rounded-lg hover:bg-gray-50 transition">
    <div class="flex items-center gap-3">
        <div class="icon-container {{ $transaction->type === 'income' ? 'success' : 'danger' }} !w-10 !h-10">
            @if($transaction->category && $transaction->category->icon)
                <span class="text-lg">{{ $transaction->category->icon }}</span>
            @else
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            @endif
        </div>
        <div>
            <p class="font-medium text-gray-900">
                {{ $transaction->category ? $transaction->category->name : 'Uncategorized' }}</p>
            <p class="text-sm text-gray-500">{{ $transaction->transaction_date->format('M d, Y') }}</p>
        </div>
    </div>
    <span class="font-bold {{ $transaction->type === 'income' ? 'text-green-600' : 'text-red-600' }}">
        {{ $transaction->type === 'income' ? '+' : '-' }}${{ number_format($transaction->amount, 2) }}
    </span>
</div>