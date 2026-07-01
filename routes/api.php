<?php

use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PlatformController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('genres', [GenreController::class, 'index']);
Route::get('platforms', [PlatformController::class, 'index']);
Route::get('games', [GameController::class, 'index']);
Route::get('games/{game}', [GameController::class, 'show']);
Route::get('news', [NewsController::class, 'index']);
Route::get('news/{news}', [NewsController::class, 'show']);
