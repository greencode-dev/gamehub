<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlatformRequest;
use App\Models\Platform;

class PlatformController extends Controller
{
    public function index()
    {
        $platforms = Platform::withCount('games')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.platforms.index', compact('platforms'));
    }

    public function create()
    {
        return view('admin.platforms.create');
    }

    public function store(StorePlatformRequest $request)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = str($data['name'])->slug()->toString();
        }

        Platform::create($data);

        return to_route('admin.platforms.index')
            ->with('success', 'Piattaforma creata con successo.');
    }

    public function edit(Platform $platform)
    {
        return view('admin.platforms.edit', compact('platform'));
    }

    public function update(StorePlatformRequest $request, Platform $platform)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = str($data['name'])->slug()->toString();
        }

        $platform->update($data);

        return to_route('admin.platforms.index')
            ->with('success', 'Piattaforma aggiornata con successo.');
    }

    public function destroy(Platform $platform)
    {
        if ($platform->games()->count() > 0) {
            return back()->with('error', 'Impossibile eliminare: la piattaforma ha giochi associati.');
        }

        $platform->delete();

        return to_route('admin.platforms.index')
            ->with('success', 'Piattaforma eliminata con successo.');
    }
}
