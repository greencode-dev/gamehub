<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Platform;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            ['title' => 'The Legend of Zelda: Tears of the Kingdom', 'slug' => 'the-legend-of-zelda-tears-of-the-kingdom', 'description' => 'An epic adventure that continues the story of Link and Zelda as they explore the vast skies and depths of Hyrule.', 'publisher' => 'Nintendo', 'release_date' => '2023-05-12', 'price' => 69.99, 'genre_id' => 2, 'platforms' => [4]],
            ['title' => 'Baldur\'s Gate 3', 'slug' => 'baldurs-gate-3', 'description' => 'A critically acclaimed RPG set in the Dungeons & Dragons universe, offering deep storytelling and tactical combat.', 'publisher' => 'Larian Studios', 'release_date' => '2023-08-03', 'price' => 59.99, 'genre_id' => 3, 'platforms' => [1, 2, 3]],
            ['title' => 'Elden Ring', 'slug' => 'elden-ring', 'description' => 'A dark fantasy action RPG from FromSoftware and George R.R. Martin, set in the vast Lands Between.', 'publisher' => 'FromSoftware', 'release_date' => '2022-02-25', 'price' => 59.99, 'genre_id' => 4, 'platforms' => [1, 2, 3, 5]],
            ['title' => 'God of War Ragnarok', 'slug' => 'god-of-war-ragnarok', 'description' => 'Kratos and Atreus journey through the Nine Realms in this epic Norse mythology sequel.', 'publisher' => 'Sony Interactive Entertainment', 'release_date' => '2022-11-09', 'price' => 69.99, 'genre_id' => 1, 'platforms' => [2, 5]],
            ['title' => 'Red Dead Redemption 2', 'slug' => 'red-dead-redemption-2', 'description' => 'An open-world Western epic following Arthur Morgan and the Van der Linde gang.', 'publisher' => 'Rockstar Games', 'release_date' => '2018-10-26', 'price' => 39.99, 'genre_id' => 2, 'platforms' => [1, 3, 5]],
            ['title' => 'Cyberpunk 2077', 'slug' => 'cyberpunk-2077', 'description' => 'An open-world RPG set in the dystopian Night City, where you play as V, a mercenary on a quest for immortality.', 'publisher' => 'CD Projekt Red', 'release_date' => '2020-12-10', 'price' => 49.99, 'genre_id' => 3, 'platforms' => [1, 2, 3, 5]],
            ['title' => 'The Witcher 3: Wild Hunt', 'slug' => 'the-witcher-3-wild-hunt', 'description' => 'Geralt of Rivia searches for his adopted daughter while battling monsters and political intrigue.', 'publisher' => 'CD Projekt Red', 'release_date' => '2015-05-19', 'price' => 29.99, 'genre_id' => 3, 'platforms' => [1, 2, 3, 4, 5]],
            ['title' => 'Spider-Man 2', 'slug' => 'spider-man-2', 'description' => 'Peter Parker and Miles Morales team up to face Venom and other threats in Marvel\'s New York.', 'publisher' => 'Sony Interactive Entertainment', 'release_date' => '2023-10-20', 'price' => 69.99, 'genre_id' => 1, 'platforms' => [2]],
            ['title' => 'Horizon Forbidden West', 'slug' => 'horizon-forbidden-west', 'description' => 'Aloy ventures west to uncover the secrets of a dying world while battling robotic creatures.', 'publisher' => 'Guerrilla Games', 'release_date' => '2022-02-18', 'price' => 59.99, 'genre_id' => 4, 'platforms' => [2, 5]],
            ['title' => 'Grand Theft Auto V', 'slug' => 'grand-theft-auto-v', 'description' => 'Three criminals navigate the seedy underworld of Los Santos in this open-world masterpiece.', 'publisher' => 'Rockstar Games', 'release_date' => '2013-09-17', 'price' => 29.99, 'genre_id' => 1, 'platforms' => [1, 2, 3, 5]],
            ['title' => 'Minecraft', 'slug' => 'minecraft', 'description' => 'A sandbox game where you build, explore, and survive in a blocky procedurally generated world.', 'publisher' => 'Mojang', 'release_date' => '2011-11-18', 'price' => 26.95, 'genre_id' => 9, 'platforms' => [1, 2, 3, 4, 5]],
            ['title' => 'Hogwarts Legacy', 'slug' => 'hogwarts-legacy', 'description' => 'An immersive open-world RPG set in the Wizarding World, where you attend Hogwarts and uncover ancient secrets.', 'publisher' => 'Warner Bros. Games', 'release_date' => '2023-02-10', 'price' => 59.99, 'genre_id' => 4, 'platforms' => [1, 2, 3, 5]],
            ['title' => 'Resident Evil 4 Remake', 'slug' => 'resident-evil-4-remake', 'description' => 'Leon S. Kennedy rescues the President\'s daughter from a mysterious cult in this survival horror classic reimagined.', 'publisher' => 'Capcom', 'release_date' => '2023-03-24', 'price' => 59.99, 'genre_id' => 6, 'platforms' => [1, 2, 3, 5]],
            ['title' => 'Street Fighter 6', 'slug' => 'street-fighter-6', 'description' => 'The legendary fighting game franchise returns with new mechanics, modes, and a vibrant roster.', 'publisher' => 'Capcom', 'release_date' => '2023-06-02', 'price' => 59.99, 'genre_id' => 7, 'platforms' => [1, 2, 3, 5]],
            ['title' => 'EA Sports FC 24', 'slug' => 'ea-sports-fc-24', 'description' => 'The premiere football simulation game with realistic gameplay, licensed teams, and Ultimate Team mode.', 'publisher' => 'EA Sports', 'release_date' => '2023-09-29', 'price' => 69.99, 'genre_id' => 8, 'platforms' => [1, 2, 3, 4, 5]],
            ['title' => 'Starfield', 'slug' => 'starfield', 'description' => 'Bethesda\'s epic space RPG that lets you explore over 1000 planets across the galaxy.', 'publisher' => 'Bethesda Softworks', 'release_date' => '2023-09-06', 'price' => 69.99, 'genre_id' => 3, 'platforms' => [1, 3]],
            ['title' => 'Assassin\'s Creed Mirage', 'slug' => 'assassins-creed-mirage', 'description' => 'Return to the roots of the franchise with a stealth-focused adventure set in ninth-century Baghdad.', 'publisher' => 'Ubisoft', 'release_date' => '2023-10-05', 'price' => 49.99, 'genre_id' => 2, 'platforms' => [1, 2, 3, 5]],
            ['title' => 'Final Fantasy VII Remake Intergrade', 'slug' => 'final-fantasy-vii-remake-intergrade', 'description' => 'The iconic RPG reimagined with stunning graphics, real-time combat, and an expanded story.', 'publisher' => 'Square Enix', 'release_date' => '2021-06-10', 'price' => 49.99, 'genre_id' => 3, 'platforms' => [1, 2, 5]],
            ['title' => 'Call of Duty: Modern Warfare III', 'slug' => 'call-of-duty-modern-warfare-iii', 'description' => 'The latest installment in the Call of Duty franchise featuring a gripping campaign and multiplayer.', 'publisher' => 'Activision', 'release_date' => '2023-11-10', 'price' => 69.99, 'genre_id' => 5, 'platforms' => [1, 2, 3, 5]],
            ['title' => 'Dark Souls III', 'slug' => 'dark-souls-iii', 'description' => 'The challenging action RPG that defined a genre, set in a dark and interconnected world.', 'publisher' => 'FromSoftware', 'release_date' => '2016-03-24', 'price' => 39.99, 'genre_id' => 4, 'platforms' => [1, 2, 3, 5]],
        ];

        $platformIds = Platform::pluck('id')->toArray();

        foreach ($games as $gameData) {
            $platforms = $gameData['platforms'];
            unset($gameData['platforms']);

            $game = Game::create($gameData);

            $game->platforms()->attach($platforms);
        }
    }
}
