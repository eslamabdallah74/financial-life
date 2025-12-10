<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="btn-gradient inline-flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('Add Category') }}
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

        @if($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($categories as $category)
                    <div
                        class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden group hover-lift border border-gray-100">
                        <div class="p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center gap-3">
                                    @if($category->icon)
                                        <div
                                            class="w-12 h-12 rounded-lg flex items-center justify-center text-2xl {{ $category->type === 'income' ? 'bg-green-50' : 'bg-red-50' }} group-hover:scale-110 transition">
                                            {{ $category->icon }}
                                        </div>
                                    @endif
                                    <div>
                                        <h3 class="font-bold text-lg text-gray-900 line-clamp-1">{{ $category->name }}</h3>
                                        <span class="category-badge {{ $category->type }} mt-1">
                                            {{ ucfirst($category->type) }}
                                        </span>
                                    </div>
                                </div>
                                @if($category->color)
                                    <div class="w-8 h-8 rounded-lg shadow-sm border-2 border-white"
                                        style="background-color: {{ $category->color }}"></div>
                                @endif
                            </div>

                            <div class="flex gap-2 pt-4 border-t border-gray-100">
                                <a href="{{ route('categories.edit', $category) }}"
                                    class="flex-1 text-center px-3 py-2 text-sm font-medium text-indigo-600 hover:text-indigo-700 hover:bg-indigo-50 rounded-md transition">
                                    {{ __('Edit') }}
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="flex-1"
                                    onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="w-full px-3 py-2 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-md transition">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-xl shadow-md p-12">
                <div class="text-center">
                    <div class="mx-auto h-24 w-24 mb-4">
                        <svg class="w-full h-full text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No categories found</h3>
                    <p class="text-gray-500 mb-6">Create your first category to organize your transactions!</p>
                    <a href="{{ route('categories.create') }}" class="btn-gradient">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        {{ __('Add Category') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>