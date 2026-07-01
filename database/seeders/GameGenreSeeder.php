<?php

namespace Database\Seeders;

use App\Models\GameGenre;
use Illuminate\Database\Seeder;

class GameGenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Action', 'slug' => 'action'],
            ['name' => 'Adventure', 'slug' => 'adventure'],
            ['name' => 'RPG', 'slug' => 'rpg'],
            ['name' => 'Action RPG', 'slug' => 'action-rpg'],
            ['name' => 'Shooter', 'slug' => 'shooter'],
            ['name' => 'Horror', 'slug' => 'horror'],
            ['name' => 'Fighting', 'slug' => 'fighting'],
            ['name' => 'Sports', 'slug' => 'sports'],
            ['name' => 'Sandbox', 'slug' => 'sandbox'],
            ['name' => 'Simulation', 'slug' => 'simulation'],
        ];

        foreach ($genres as $genre) {
            GameGenre::create($genre);
        }
    }
}
