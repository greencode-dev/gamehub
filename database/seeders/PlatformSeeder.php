<?php

namespace Database\Seeders;

use App\Models\Platform;
use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    public function run(): void
    {
        $platforms = [
            ['name' => 'PC', 'slug' => 'pc', 'manufacturer' => 'Microsoft'],
            ['name' => 'PlayStation 5', 'slug' => 'playstation-5', 'manufacturer' => 'Sony'],
            ['name' => 'Xbox Series X|S', 'slug' => 'xbox-series', 'manufacturer' => 'Microsoft'],
            ['name' => 'Nintendo Switch', 'slug' => 'nintendo-switch', 'manufacturer' => 'Nintendo'],
            ['name' => 'PlayStation 4', 'slug' => 'playstation-4', 'manufacturer' => 'Sony'],
        ];

        foreach ($platforms as $platform) {
            Platform::create($platform);
        }
    }
}
