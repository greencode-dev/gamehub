<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $game->title }}</h2>
            <a href="{{ route('admin.games.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                &larr; Torna alla lista
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="md:col-span-1">
                            @if ($game->cover_path)
                                <img src="{{ Storage::url($game->cover_path) }}" alt="{{ $game->title }}" class="w-full rounded-lg shadow">
                            @else
                                <div class="w-full aspect-[3/4] bg-gray-200 rounded-lg flex items-center justify-center text-gray-400">Nessuna copertina</div>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div>
                                    <p class="text-sm text-gray-500">Editore</p>
                                    <p class="font-medium">{{ $game->publisher }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Genere</p>
                                    <p class="font-medium">{{ $game->genre->name ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Data di uscita</p>
                                    <p class="font-medium">{{ $game->release_date?->format('d/m/Y') ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Prezzo</p>
                                    <p class="font-medium">&euro;{{ number_format($game->price, 2) }}</p>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Descrizione</h3>
                                <p class="text-gray-700">{{ $game->description ?? 'Nessuna descrizione disponibile.' }}</p>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Piattaforme</h3>
                                <div class="flex flex-wrap gap-2">
                                    @forelse ($game->platforms as $platform)
                                        <span class="inline-block bg-indigo-100 text-indigo-800 rounded-full px-3 py-1 text-sm font-medium">{{ $platform->name }}</span>
                                    @empty
                                        <p class="text-gray-500">Nessuna piattaforma associata.</p>
                                    @endforelse
                                </div>
                            </div>

                            @if ($game->news->isNotEmpty())
                                <div>
                                    <h3 class="text-lg font-semibold mb-2">News correlate</h3>
                                    <ul class="divide-y divide-gray-200">
                                        @foreach ($game->news as $newsItem)
                                            <li class="py-2">
                                                <p class="text-sm font-medium">{{ $newsItem->title }}</p>
                                                <p class="text-xs text-gray-500">{{ $newsItem->published_at?->format('d/m/Y') }}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mt-8 flex gap-2">
                                <a href="{{ route('admin.games.edit', $game) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Modifica</a>
                                <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="inline" onsubmit="return confirm('Eliminare questo gioco?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Elimina</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
