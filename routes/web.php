<?php

use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\GameGenreController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\PlatformController;
use App\Http\Controllers\ProfileController;
use App\Models\Game;
use App\Models\GameGenre;
use App\Models\News;
use App\Models\Platform;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('spa');
});

Route::get('/dashboard', function () {
    return view('dashboard', [
        'stats' => [
            'games' => Game::count(),
            'news' => News::count(),
            'genres' => GameGenre::count(),
            'platforms' => Platform::count(),
        ],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::resource('genres', GameGenreController::class)
        ->except(['show']);
    Route::resource('platforms', PlatformController::class)
        ->except(['show']);
    Route::resource('games', GameController::class);
    Route::resource('news', NewsController::class);
});

require __DIR__.'/auth.php';

Route::get('/{any}', function () {
    return view('spa');
})->where('any', '.*');
