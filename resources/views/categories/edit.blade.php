<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('categories.update', $category) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                :value="old('name', $category->name)" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="type" :value="__('Type')" />
                            <select id="type" name="type"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">{{ __('Select Type') }}</option>
                                <option value="income" {{ old('type', $category->type) == 'income' ? 'selected' : '' }}>
                                    {{ __('Income') }}</option>
                                <option value="expense" {{ old('type', $category->type) == 'expense' ? 'selected' : '' }}>
                                    {{ __('Expense') }}</option>
                            </select>
                            <x-input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="icon" :value="__('Icon (emoji)')" />
                            <x-text-input id="icon" name="icon" type="text" class="mt-1 block w-full"
                                :value="old('icon', $category->icon)" placeholder="🏠" />
                            <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="color" :value="__('Color')" />
                            <input id="color" name="color" type="color"
                                class="mt-1 block h-10 w-20 border-gray-300 rounded-md shadow-sm"
                                value="{{ old('color', $category->color ?? '#3B82F6') }}" />
                            <x-input-error :messages="$errors->get('color')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4 mt-6">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
                            <a href="{{ route('categories.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>