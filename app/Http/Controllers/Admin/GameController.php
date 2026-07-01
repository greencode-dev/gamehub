<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGameRequest;
use App\Models\Game;
use App\Models\GameGenre;
use App\Models\Platform;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with(['genre', 'platforms'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.games.index', compact('games'));
    }

    public function create()
    {
        $genres = GameGenre::orderBy('name')->get();
        $platforms = Platform::orderBy('name')->get();

        return view('admin.games.create', compact('genres', 'platforms'));
    }

    public function store(StoreGameRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = str($data['title'])->slug()->toString();
        }

        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('covers', 'public');
        }

        $platforms = $data['platforms'] ?? [];
        unset($data['platforms'], $data['cover']);

        $game = Game::create($data);

        if (! empty($platforms)) {
            $game->platforms()->attach($platforms);
        }

        return to_route('admin.games.index')
            ->with('success', 'Gioco creato con successo.');
    }

    public function show(Game $game)
    {
        $game->load(['genre', 'platforms', 'news']);

        return view('admin.games.show', compact('game'));
    }

    public function edit(Game $game)
    {
        $genres = GameGenre::orderBy('name')->get();
        $platforms = Platform::orderBy('name')->get();
        $game->load('platforms');

        return view('admin.games.edit', compact('game', 'genres', 'platforms'));
    }

    public function update(StoreGameRequest $request, Game $game)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = str($data['title'])->slug()->toString();
        }

        if ($request->hasFile('cover')) {
            if ($game->cover_path) {
                Storage::disk('public')->delete($game->cover_path);
            }

            $data['cover_path'] = $request->file('cover')->store('covers', 'public');
        }

        $platforms = $data['platforms'] ?? [];
        unset($data['platforms'], $data['cover']);

        $game->update($data);

        if (! empty($platforms)) {
            $game->platforms()->sync($platforms);
        } else {
            $game->platforms()->detach();
        }

        return to_route('admin.games.index')
            ->with('success', 'Gioco aggiornato con successo.');
    }

    public function destroy(Game $game)
    {
        if ($game->cover_path) {
            Storage::disk('public')->delete($game->cover_path);
        }

        $game->platforms()->detach();
        $game->delete();

        return to_route('admin.games.index')
            ->with('success', 'Gioco eliminato con successo.');
    }
}
