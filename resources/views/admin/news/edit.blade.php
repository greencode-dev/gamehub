<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifica News</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Titolo</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $news->title) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug', $news->slug) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('slug')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="game_id" class="block text-sm font-medium text-gray-700">Gioco correlato</label>
                                <select name="game_id" id="game_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Nessuno</option>
                                    @foreach ($games as $game)
                                        <option value="{{ $game->id }}" {{ old('game_id', $news->game_id) == $game->id ? 'selected' : '' }}>{{ $game->title }}</option>
                                    @endforeach
                                </select>
                                @error('game_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="published_at" class="block text-sm font-medium text-gray-700">Data di pubblicazione</label>
                                <input type="date" name="published_at" id="published_at" value="{{ old('published_at', $news->published_at?->format('Y-m-d')) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('published_at')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Contenuto</label>
                            <textarea name="content" id="content" rows="8"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Immagine</label>
                            @if ($news->image_path)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($news->image_path) }}" alt="{{ $news->title }}" class="h-32 object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="image" id="image" accept="image/jpeg,image/png,image/webp"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="text-gray-500 text-xs mt-1">Lascia vuoto per mantenere l'immagine attuale.</p>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('admin.news.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2">Annulla</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Aggiorna</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
