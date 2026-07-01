<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'publisher',
        'release_date',
        'price',
        'genre_id',
        'cover_path',
    ];

    protected function casts(): array
    {
        return [
            'release_date' => 'date',
            'price' => 'decimal:2',
        ];
    }

    public function genre(): BelongsTo
    {
        return $this->belongsTo(GameGenre::class, 'genre_id');
    }

    public function platforms(): BelongsToMany
    {
        return $this->belongsToMany(Platform::class, 'game_platform')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }
}
