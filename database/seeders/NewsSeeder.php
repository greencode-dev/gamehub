<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\News;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $newsItems = [
            [
                'title' => 'Elden Ring Shadow of the Erdtree DLC Announced',
                'slug' => 'elden-ring-shadow-of-the-erdtree-dlc',
                'content' => 'FromSoftware has announced the highly anticipated DLC for Elden Ring titled "Shadow of the Erdtree". Players will explore a new realm filled with challenging bosses and mysterious lore.',
                'game_slug' => 'elden-ring',
                'published_at' => '2024-02-21',
            ],
            [
                'title' => 'Baldur\'s Gate 3 Wins Game of the Year',
                'slug' => 'baldurs-gate-3-goty',
                'content' => 'Larian Studios\' Baldur\'s Gate 3 has won Game of the Year at The Game Awards 2023, cementing its place as one of the greatest RPGs ever made.',
                'game_slug' => 'baldurs-gate-3',
                'published_at' => '2023-12-07',
            ],
            [
                'title' => 'Cyberpunk 2077 Phantom Liberty Expansion Launches',
                'slug' => 'cyberpunk-phantom-liberty',
                'content' => 'CD Projekt Red has released the Phantom Liberty expansion for Cyberpunk 2077, featuring Idris Elba and a new spy-thriller storyline set in Dogtown.',
                'game_slug' => 'cyberpunk-2077',
                'published_at' => '2023-09-26',
            ],
            [
                'title' => 'Nintendo Switch 2 Announced for 2025',
                'slug' => 'nintendo-switch-2-announced',
                'content' => 'Nintendo has officially confirmed the successor to the Nintendo Switch, promising backward compatibility and enhanced performance.',
                'game_slug' => null,
                'published_at' => '2024-06-15',
            ],
            [
                'title' => 'God of War Ragnarok PC Port Coming Soon',
                'slug' => 'god-of-war-ragnarok-pc',
                'content' => 'Sony has confirmed that God of War Ragnarok will be released on PC in 2024, following the successful PC port of the 2018 God of War.',
                'game_slug' => 'god-of-war-ragnarok',
                'published_at' => '2024-01-10',
            ],
            [
                'title' => 'The Witcher 4 Officially in Development',
                'slug' => 'the-witcher-4-development',
                'content' => 'CD Projekt Red has announced that the next Witcher game is officially in development using Unreal Engine 5, marking a new saga in the franchise.',
                'game_slug' => 'the-witcher-3-wild-hunt',
                'published_at' => '2024-03-28',
            ],
            [
                'title' => 'Starfield Shattered Space Expansion Details',
                'slug' => 'starfield-shattered-space',
                'content' => 'Bethesda has revealed the first story expansion for Starfield, titled "Shattered Space", which will introduce new locations and deeper narrative content.',
                'game_slug' => 'starfield',
                'published_at' => '2024-06-09',
            ],
        ];

        foreach ($newsItems as $item) {
            $gameId = null;

            if ($item['game_slug']) {
                $game = Game::where('slug', $item['game_slug'])->first();
                $gameId = $game?->id;
            }

            News::create([
                'title' => $item['title'],
                'slug' => $item['slug'],
                'content' => $item['content'],
                'game_id' => $gameId,
                'published_at' => $item['published_at'],
            ]);
        }
    }
}
