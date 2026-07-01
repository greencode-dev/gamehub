<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifica Gioco</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.games.update', $game) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="mb-4">
                                <label for="title" class="block text-sm font-medium text-gray-700">Titolo</label>
                                <input type="text" name="title" id="title" value="{{ old('title', $game->title) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('title')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                                <input type="text" name="slug" id="slug" value="{{ old('slug', $game->slug) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('slug')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="publisher" class="block text-sm font-medium text-gray-700">Editore</label>
                                <input type="text" name="publisher" id="publisher" value="{{ old('publisher', $game->publisher) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('publisher')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="genre_id" class="block text-sm font-medium text-gray-700">Genere</label>
                                <select name="genre_id" id="genre_id"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Seleziona un genere</option>
                                    @foreach ($genres as $genre)
                                        <option value="{{ $genre->id }}" {{ old('genre_id', $game->genre_id) == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                                    @endforeach
                                </select>
                                @error('genre_id')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">Prezzo (&euro;)</label>
                                <input type="number" step="0.01" min="0" name="price" id="price" value="{{ old('price', $game->price) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('price')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="release_date" class="block text-sm font-medium text-gray-700">Data di uscita</label>
                                <input type="date" name="release_date" id="release_date" value="{{ old('release_date', $game->release_date?->format('Y-m-d')) }}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('release_date')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descrizione</label>
                            <textarea name="description" id="description" rows="5"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $game->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cover" class="block text-sm font-medium text-gray-700">Copertina</label>
                            @if ($game->cover_path)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($game->cover_path) }}" alt="{{ $game->title }}" class="h-32 object-cover rounded">
                                </div>
                            @endif
                            <input type="file" name="cover" id="cover" accept="image/jpeg,image/png,image/webp"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="text-gray-500 text-xs mt-1">Lascia vuoto per mantenere la copertina attuale.</p>
                            @error('cover')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Piattaforme</label>
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-2">
                                @foreach ($platforms as $platform)
                                    <label class="inline-flex items-center">
                                        <input type="checkbox" name="platforms[]" value="{{ $platform->id }}"
                                            {{ $game->platforms->contains($platform->id) ? 'checked' : '' }}
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                        <span class="ml-2 text-sm text-gray-700">{{ $platform->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('platforms')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('admin.games.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2">Annulla</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Aggiorna</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
