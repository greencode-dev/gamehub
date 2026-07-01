<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Platform;

class PlatformController extends Controller
{
    public function index()
    {
        return Platform::withCount('games')
            ->orderBy('name')
            ->get();
    }
}
