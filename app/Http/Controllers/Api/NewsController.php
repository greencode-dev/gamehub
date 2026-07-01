<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        return News::with('game')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }

    public function show(News $news)
    {
        return $news->load('game');
    }
}
