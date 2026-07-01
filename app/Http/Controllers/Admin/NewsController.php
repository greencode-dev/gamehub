<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use App\Models\Game;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('game')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $games = Game::orderBy('title')->get();

        return view('admin.news.create', compact('games'));
    }

    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = str($data['title'])->slug()->toString();
        }

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('news', 'public');
        }

        unset($data['image']);

        News::create($data);

        return to_route('admin.news.index')
            ->with('success', 'News creata con successo.');
    }

    public function show(News $news)
    {
        $news->load('game');

        return view('admin.news.show', compact('news'));
    }

    public function edit(News $news)
    {
        $games = Game::orderBy('title')->get();

        return view('admin.news.edit', compact('news', 'games'));
    }

    public function update(StoreNewsRequest $request, News $news)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = str($data['title'])->slug()->toString();
        }

        if ($request->hasFile('image')) {
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }

            $data['image_path'] = $request->file('image')->store('news', 'public');
        }

        unset($data['image']);

        $news->update($data);

        return to_route('admin.news.index')
            ->with('success', 'News aggiornata con successo.');
    }

    public function destroy(News $news)
    {
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }

        $news->delete();

        return to_route('admin.news.index')
            ->with('success', 'News eliminata con successo.');
    }
}
