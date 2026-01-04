<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">
                    Categories
                </h2>
                <p class="mt-1 text-sm text-gray-600">Organize your income and expense categories</p>
            </div>
            <a href="{{ route('categories.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 active:bg-gray-950 transition-colors duration-200 shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Category
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" 
        x-data="{ 
            showDeleteModal: false, 
            categoryName: '', 
            deleteRoute: '' 
        }">
        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                <div class="flex items-start gap-3">
                    <div class="flex-shrink-0 w-5 h-5 text-emerald-600 mt-0.5">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-emerald-900">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Categories Grid -->
        @if($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <div class="bg-white rounded-xl border border-gray-200 hover:border-gray-300 hover:shadow-lg transition-all duration-200 overflow-hidden group">
                        <!-- Card Header -->
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-start gap-4 flex-1 min-w-0">
                                    <!-- Icon -->
                                    @if($category->icon)
                                        <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center text-2xl transition-transform duration-200 group-hover:scale-110 {{ $category->type === 'income' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                            {{ $category->icon }}
                                        </div>
                                    @else
                                        <div class="flex-shrink-0 w-12 h-12 rounded-lg flex items-center justify-center bg-gray-100 text-gray-400 transition-transform duration-200 group-hover:scale-110">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <!-- Category Info -->
                                    <div class="flex-1 min-w-0">
                                        <h3 class="font-semibold text-lg text-gray-900 truncate mb-1.5">
                                            {{ $category->name }}
                                        </h3>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-medium {{ $category->type === 'income' ? 'bg-emerald-100 text-emerald-800' : 'bg-rose-100 text-rose-800' }}">
                                            {{ ucfirst($category->type) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <!-- Color Indicator -->
                                @if($category->color)
                                    <div class="flex-shrink-0 w-8 h-8 rounded-lg border-2 border-white shadow-sm transition-transform duration-200 group-hover:scale-110"
                                        style="background-color: {{ $category->color }}"></div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Actions -->
                        <div class="px-6 pb-6 pt-2 flex gap-3 border-t border-gray-100">
                            <a href="{{ route('categories.edit', $category) }}"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-gray-700 bg-gray-50 hover:bg-gray-100 active:bg-gray-200 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <button type="button"
                                @click="showDeleteModal = true; categoryName = '{{ $category->name }}'; deleteRoute = '{{ route('categories.destroy', $category) }}'"
                                class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-medium text-rose-700 bg-rose-50 hover:bg-rose-100 active:bg-rose-200 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                <div class="max-w-md mx-auto">
                    <!-- Icon -->
                    <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    
                    <!-- Text -->
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No categories yet</h3>
                    <p class="text-gray-600 mb-8">Get started by creating your first category to organize your finances.</p>
                    
                    <!-- CTA Button -->
                    <a href="{{ route('categories.create') }}" 
                        class="inline-flex items-center gap-2 px-5 py-3 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 active:bg-gray-950 transition-colors duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Your First Category
                    </a>
                </div>
            </div>
        @endif

        <x-delete-confirmation-modal 
            show="showDeleteModal"
            title="Delete Category?"
            itemName="categoryName"
            action="deleteRoute"
            message="Are you sure you want to delete <span class='font-bold text-gray-900' x-text='categoryName'></span>? <br>This will also affect transactions associated with it. This action cannot be undone."
        />
    </div>
</x-app-layout>