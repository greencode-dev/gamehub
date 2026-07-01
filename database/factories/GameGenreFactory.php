<?php

namespace Database\Factories;

use App\Models\GameGenre;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameGenreFactory extends Factory
{
    protected $model = GameGenre::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'slug' => fn (array $attrs) => str($attrs['name'])->slug()->toString(),
        ];
    }
}
