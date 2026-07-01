<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\GameGenre;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition(): array
    {
        $title = fake()->unique()->words(3, true);

        return [
            'title' => $title,
            'slug' => str()->slug($title),
            'description' => fake()->paragraphs(3, true),
            'publisher' => fake()->company(),
            'release_date' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
            'price' => fake()->randomFloat(2, 19.99, 79.99),
            'genre_id' => GameGenre::inRandomOrder()->first()?->id ?? 1,
            'cover_path' => null,
        ];
    }
}
