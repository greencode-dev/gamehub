<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">News</h2>
            <a href="{{ route('admin.news.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                + Nuova News
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titolo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gioco</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pubblicata il</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Azioni</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($news as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $item->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->game?->title ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $item->published_at?->format('d/m/Y') ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('admin.news.show', $item) }}" class="text-gray-600 hover:text-gray-900 mr-2">Dettaglio</a>
                                        <a href="{{ route('admin.news.edit', $item) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Modifica</a>
                                        <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Eliminare questa news?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Elimina</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">Nessuna news trovata.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">{{ $news->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
