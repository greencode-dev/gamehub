<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;

class GameController extends Controller
{
    public function index()
    {
        return Game::with(['genre', 'platforms'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);
    }

    public function show(Game $game)
    {
        return $game->load(['genre', 'platforms', 'news']);
    }
}
