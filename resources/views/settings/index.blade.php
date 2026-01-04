<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 leading-tight">
                    {{ __('Settings') }}
                </h2>
                <p class="mt-1 text-sm text-gray-600">Manage your account preferences and application settings</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-8">
        @if(session('success'))
            <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl flex items-center gap-3 animate-fade-in">
                <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <p class="text-sm font-medium text-emerald-900">{{ session('success') }}</p>
            </div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PATCH')

            <!-- Preferences Section -->
            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="p-8 border-b border-gray-50 flex items-center gap-4">
                    <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">General Preferences</h3>
                        <p class="text-sm text-gray-500">Customize how you interact with the app</p>
                    </div>
                </div>

                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Currency -->
                    <div class="space-y-2">
                        <label for="currency" class="block text-sm font-semibold text-gray-700">Base Currency</label>
                        <select id="currency" name="currency"
                            class="w-full px-4 py-3 bg-gray-50 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all">
                            @foreach($currencies as $code => $name)
                                <option value="{{ $code }}" {{ $settings->currency === $code ? 'selected' : '' }}>
                                    {{ $code }} - {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Language -->
                    <div class="space-y-2">
                        <label for="language" class="block text-sm font-semibold text-gray-700">Language</label>
                        <select id="language" name="language"
                            class="w-full px-4 py-3 bg-gray-50 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all">
                            <option value="en" {{ $settings->language === 'en' ? 'selected' : '' }}>English</option>
                            <option value="ar" {{ $settings->language === 'ar' ? 'selected' : '' }}>العربية (Arabic)
                            </option>
                        </select>
                    </div>

                    <!-- Theme -->
                    <div class="space-y-2">
                        <label for="theme" class="block text-sm font-semibold text-gray-700">Display Theme</label>
                        <select id="theme" name="theme"
                            class="w-full px-4 py-3 bg-gray-50 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all">
                            <option value="light" {{ $settings->theme === 'light' ? 'selected' : '' }}>Light</option>
                            <option value="dark" {{ $settings->theme === 'dark' ? 'selected' : '' }}>Dark</option>
                            <option value="auto" {{ $settings->theme === 'auto' ? 'selected' : '' }}>System Default
                            </option>
                        </select>
                    </div>

                    <!-- Timezone -->
                    <div class="space-y-2">
                        <label for="timezone" class="block text-sm font-semibold text-gray-700">Timezone</label>
                        <select id="timezone" name="timezone"
                            class="w-full px-4 py-3 bg-gray-50 border-gray-200 rounded-xl focus:ring-4 focus:ring-indigo-100 focus:border-indigo-500 transition-all">
                            @foreach(timezone_identifiers_list() as $tz)
                                <option value="{{ $tz }}" {{ $settings->timezone === $tz ? 'selected' : '' }}>{{ $tz }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <!-- Cloud Section -->
            <div
                class="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-3xl p-8 text-white shadow-xl shadow-indigo-200 overflow-hidden relative">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-20 -mt-20 blur-3xl"></div>
                <div class="relative flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-14 h-14 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold">Cloud Synchronization</h3>
                            <p class="text-indigo-100 text-sm">Keep your data safe and synced across devices</p>
                        </div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="cloud_sync_enabled" value="1" {{ $settings->cloud_sync_enabled ? 'checked' : '' }} class="sr-only peer">
                        <div
                            class="w-16 h-9 bg-black/20 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-7 after:w-7 after:transition-all peer-checked:bg-white peer-checked:after:bg-indigo-600">
                        </div>
                    </label>
                </div>
            </div>

            <!-- Save Button -->
            <div class="flex items-center justify-end pt-4">
                <button type="submit"
                    class="px-8 py-4 bg-gray-900 text-white font-bold rounded-2xl shadow-xl hover:bg-black hover:scale-105 active:scale-95 transition-all flex items-center gap-3 group">
                    <span>Save Changes</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>