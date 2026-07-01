<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Platform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'manufacturer',
    ];

    public function games(): BelongsToMany
    {
        return $this->belongsToMany(Game::class, 'game_platform')
            ->withPivot('price')
            ->withTimestamps();
    }
}
