<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <a href="{{ route('admin.games.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <p class="text-sm text-gray-500 uppercase tracking-wider">Giochi</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $stats['games'] ?? 0 }}</p>
                </a>
                <a href="{{ route('admin.news.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <p class="text-sm text-gray-500 uppercase tracking-wider">News</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['news'] ?? 0 }}</p>
                </a>
                <a href="{{ route('admin.genres.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <p class="text-sm text-gray-500 uppercase tracking-wider">Generi</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $stats['genres'] ?? 0 }}</p>
                </a>
                <a href="{{ route('admin.platforms.index') }}" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:shadow-lg transition-shadow">
                    <p class="text-sm text-gray-500 uppercase tracking-wider">Piattaforme</p>
                    <p class="text-3xl font-bold text-orange-600">{{ $stats['platforms'] ?? 0 }}</p>
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Gestione rapida</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('admin.games.create') }}" class="block p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition text-center">
                        <span class="text-indigo-600 font-medium">+ Nuovo Gioco</span>
                    </a>
                    <a href="{{ route('admin.news.create') }}" class="block p-4 bg-green-50 rounded-lg hover:bg-green-100 transition text-center">
                        <span class="text-green-600 font-medium">+ Nuova News</span>
                    </a>
                    <a href="{{ route('admin.genres.create') }}" class="block p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition text-center">
                        <span class="text-purple-600 font-medium">+ Nuovo Genere</span>
                    </a>
                    <a href="{{ route('admin.platforms.create') }}" class="block p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition text-center">
                        <span class="text-orange-600 font-medium">+ Nuova Piattaforma</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
