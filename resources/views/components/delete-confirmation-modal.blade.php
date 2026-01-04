@props([
    'id' => 'delete-modal',
    'show' => 'showDeleteModal',
    'title' => 'Are you sure?',
    'message' => null,
    'action' => 'deleteRoute',
    'itemName' => 'itemName'
])

<template x-teleport="body">
    <div x-show="{{ $show }}" 
        id="{{ $id }}"
        class="fixed inset-0 z-[100] flex items-center justify-center p-4"
        x-cloak>
        <!-- Backdrop -->
        <div x-show="{{ $show }}" 
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm"
            @click="{{ $show }} = false"></div>

        <!-- Modal Panel -->
        <div x-show="{{ $show }}" 
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-4"
            class="relative w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 mx-auto"
            style="max-width: 500px;">
            
            <div class="p-8">
                <div class="flex items-center justify-center w-16 h-16 mx-auto bg-rose-50 rounded-2xl mb-6">
                    <svg class="w-8 h-8 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>

                <div class="text-center">
                    <h3 class="text-2xl font-black text-gray-900 mb-2">{{ $title }}</h3>
                    <div class="text-gray-500 leading-relaxed">
                        @isset($slot)
                            {{ $slot }}
                        @else
                            @if($message)
                                {!! $message !!}
                            @else
                                Are you sure you want to delete <span class="font-bold text-gray-900" x-text="{{ $itemName }}"></span>? 
                                <br>This action cannot be undone.
                            @endif
                        @endisset
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 mt-10">
                    <button @click="{{ $show }} = false" 
                        class="flex-1 px-6 py-4 bg-gray-100 text-gray-700 font-bold rounded-2xl hover:bg-gray-200 transition-colors">
                        Cancel
                    </button>
                    <form :action="{{ $action }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                            class="w-full px-6 py-4 bg-rose-600 text-white font-bold rounded-2xl shadow-lg shadow-rose-200 hover:bg-rose-700 active:scale-[0.98] transition-all">
                            Delete Now
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
