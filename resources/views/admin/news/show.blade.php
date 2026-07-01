<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $news->title }}</h2>
            <a href="{{ route('admin.news.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                &larr; Torna alla lista
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        @if ($news->image_path)
                            <div class="md:col-span-1">
                                <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}" class="w-full rounded-lg shadow">
                            </div>
                        @endif

                        <div class="{{ $news->image_path ? 'md:col-span-2' : 'md:col-span-3' }}">
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div>
                                    <p class="text-sm text-gray-500">Gioco correlato</p>
                                    <p class="font-medium">{{ $news->game?->title ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Pubblicata il</p>
                                    <p class="font-medium">{{ $news->published_at?->format('d/m/Y') ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Contenuto</h3>
                                <p class="text-gray-700 whitespace-pre-line">{{ $news->content }}</p>
                            </div>

                            <div class="mt-8 flex gap-2">
                                <a href="{{ route('admin.news.edit', $news) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">Modifica</a>
                                <form action="{{ route('admin.news.destroy', $news) }}" method="POST" class="inline" onsubmit="return confirm('Eliminare questa news?')">
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
