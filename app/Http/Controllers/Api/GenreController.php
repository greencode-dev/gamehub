<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GameGenre;

class GenreController extends Controller
{
    public function index()
    {
        return GameGenre::withCount('games')
            ->orderBy('name')
            ->get();
    }
}
