<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-4xl font-black tracking-tight">
                    <span
                        class="bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                        Categories
                    </span>
                </h2>
                <p class="mt-1 text-sm text-gray-500">Manage your income and expense categories</p>
            </div>
            <a href="{{ route('categories.create') }}"
                class="group relative overflow-hidden px-5 py-2.5 bg-gray-900 text-white rounded-full font-medium shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                <span class="relative z-10 flex items-center gap-2">
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    New Category
                </span>
                <div
                    class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left">
                </div>
            </a>
        </div>
    </x-slot>

    <div class="relative max-w-6xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Decorative Background Elements -->
        <div
            class="absolute top-10 -left-10 w-72 h-72 bg-gradient-to-br from-indigo-400 to-purple-600 rounded-full opacity-10 blur-3xl">
        </div>
        <div
            class="absolute bottom-10 -right-10 w-96 h-96 bg-gradient-to-tr from-pink-400 to-orange-400 rounded-full opacity-10 blur-3xl">
        </div>

        <div class="relative fade-in">
            @if(session('success'))
                <div class="mb-8 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-2xl shadow-sm">
                    <div class="flex items-center">
                        <div class="p-2 bg-emerald-100 rounded-xl mr-3 text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <p class="text-emerald-800 font-bold">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if($categories->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($categories as $category)
                        <div
                            class="group relative bg-white/80 backdrop-blur-xl rounded-[2.5rem] p-8 border border-white shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                            <div
                                class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 via-purple-50/50 to-pink-50/50 rounded-[2.5rem] opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            </div>
                            
                            <div class="relative">
                                <div class="flex items-start justify-between mb-8">
                                    <div class="flex items-center gap-5">
                                        @if($category->icon)
                                            <div
                                                class="w-20 h-20 rounded-[1.5rem] flex items-center justify-center text-4xl shadow-inner transition-all duration-500 group-hover:scale-110 group-hover:rotate-6 {{ $category->type === 'income' ? 'bg-emerald-50 text-emerald-600 border border-emerald-100' : 'bg-rose-50 text-rose-600 border border-rose-100' }}">
                                                {{ $category->icon }}
                                            </div>
                                        @else
                                            <div class="w-20 h-20 rounded-[1.5rem] flex items-center justify-center bg-gray-50 border border-gray-100 text-gray-400 group-hover:scale-110 transition-transform duration-500">
                                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                </svg>
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="font-black text-2xl text-gray-900 tracking-tight line-clamp-1 leading-tight">{{ $category->name }}</h3>
                                            <div class="mt-2">
                                                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest {{ $category->type === 'income' ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                                    {{ $category->type }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($category->color)
                                        <div class="w-12 h-12 rounded-2xl shadow-xl border-4 border-white transform -rotate-12 group-hover:rotate-0 transition-all duration-500 group-hover:scale-110"
                                            style="background-color: {{ $category->color }}"></div>
                                    @endif
                                </div>

                                <div class="flex gap-4 pt-8 border-t border-gray-100/50">
                                    <a href="{{ route('categories.edit', $category) }}"
                                        class="flex-1 flex items-center justify-center gap-2 px-6 py-4 text-sm font-black text-indigo-600 bg-indigo-50 hover:bg-indigo-600 hover:text-white rounded-[1.25rem] transition-all duration-300 shadow-sm hover:shadow-indigo-200">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" class="flex-1"
                                        onsubmit="return confirm('Are you sure you want to delete this category? This will also affect transactions associated with it.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full flex items-center justify-center gap-2 px-6 py-4 text-sm font-black text-rose-600 bg-rose-50 hover:bg-rose-600 hover:text-white rounded-[1.25rem] transition-all duration-300 shadow-sm hover:shadow-rose-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="relative bg-white/80 backdrop-blur-xl rounded-[4rem] p-16 sm:p-24 border border-white shadow-2xl text-center overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/40 via-transparent to-pink-50/40"></div>
                    
                    <div class="relative max-w-lg mx-auto">
                        <div class="mx-auto w-48 h-48 bg-gradient-to-br from-white to-gray-50 rounded-full flex items-center justify-center mb-10 shadow-2xl relative">
                            <div class="absolute inset-4 rounded-full border-4 border-dashed border-gray-200 animate-[spin_20s_linear_infinite]"></div>
                            <svg class="w-24 h-24 text-gray-300 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <h3 class="text-4xl font-black text-gray-900 mb-6 tracking-tight">Your toolkit is empty</h3>
                        <p class="text-xl text-gray-500 mb-12 leading-relaxed">Starting fresh is the best part! Create your first category to start organizing your financial world with precision.</p>
                        
                        <a href="{{ route('categories.create') }}" 
                            class="inline-flex items-center gap-4 px-10 py-5 bg-gray-900 text-white rounded-full font-black text-xl shadow-[0_20px_50px_rgba(0,0,0,0.3)] hover:bg-black hover:scale-105 hover:-translate-y-1 transition-all duration-300 group">
                            <svg class="w-7 h-7 transition-transform group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Your First Category
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>