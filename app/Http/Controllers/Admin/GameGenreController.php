<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGameGenreRequest;
use App\Models\GameGenre;

class GameGenreController extends Controller
{
    public function index()
    {
        $genres = GameGenre::withCount('games')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.genres.index', compact('genres'));
    }

    public function create()
    {
        return view('admin.genres.create');
    }

    public function store(StoreGameGenreRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = str($data['name'])->slug()->toString();
        }

        GameGenre::create($data);

        return to_route('admin.genres.index')
            ->with('success', 'Genere creato con successo.');
    }

    public function edit(GameGenre $genre)
    {
        return view('admin.genres.edit', compact('genre'));
    }

    public function update(StoreGameGenreRequest $request, GameGenre $genre)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = str($data['name'])->slug()->toString();
        }

        $genre->update($data);

        return to_route('admin.genres.index')
            ->with('success', 'Genere aggiornato con successo.');
    }

    public function destroy(GameGenre $genre)
    {
        if ($genre->games()->count() > 0) {
            return back()->with('error', 'Impossibile eliminare: il genere ha giochi associati.');
        }

        $genre->delete();

        return to_route('admin.genres.index')
            ->with('success', 'Genere eliminato con successo.');
    }
}
