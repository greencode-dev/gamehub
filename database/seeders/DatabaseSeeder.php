<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GameGenreSeeder::class,
            PlatformSeeder::class,
            GameSeeder::class,
            NewsSeeder::class,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gamehub.dev',
            'password' => bcrypt('password'),
        ]);
    }
}
