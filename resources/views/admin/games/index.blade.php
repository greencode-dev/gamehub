<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Giochi</h2>
            <a href="{{ route('admin.games.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Nuovo Gioco
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Copertina</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titolo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genere</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prezzo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Piattaforme</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Azioni</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($games as $game)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($game->cover_path)
                                            <img src="{{ Storage::url($game->cover_path) }}" alt="{{ $game->title }}" class="h-12 w-12 object-cover rounded">
                                        @else
                                            <div class="h-12 w-12 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">N/A</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $game->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $game->genre->name ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">&euro;{{ number_format($game->price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($game->platforms as $platform)
                                            <span class="inline-block bg-gray-100 rounded px-2 py-1 text-xs mr-1">{{ $platform->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.games.show', $game) }}" class="text-gray-600 hover:text-gray-900 mr-2">Dettaglio</a>
                                        <a href="{{ route('admin.games.edit', $game) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifica</a>
                                        <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="inline" onsubmit="return confirm('Eliminare questo gioco?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Elimina</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Nessun gioco trovato.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">{{ $games->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
