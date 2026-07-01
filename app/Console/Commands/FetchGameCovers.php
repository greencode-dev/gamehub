<?php

namespace App\Console\Commands;

use App\Models\Game;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FetchGameCovers extends Command
{
    protected $signature = 'gamehub:fetch-covers {game? : Specific game slug}';

    protected $description = 'Fetch game covers from Wikipedia for all games without a cover';

    public function handle(): void
    {
        $query = Game::whereNull('cover_path');

        if ($slug = $this->argument('game')) {
            $query->where('slug', $slug);
        }

        $games = $query->get();

        if ($games->isEmpty()) {
            $this->info('All games already have covers.');

            return;
        }

        foreach ($games as $game) {
            $this->line("Processing: {$game->title}");

            $imageUrl = $this->fetchFromWikipedia($game->title);

            if ($imageUrl) {
                $this->line("  Found: {$imageUrl}");
                $contents = Http::timeout(10)->get($imageUrl)->body();

                if (! empty($contents)) {
                    $filename = 'covers/'.Str::slug($game->title).'.jpg';
                    Storage::disk('public')->put($filename, $contents);
                    $game->update(['cover_path' => $filename]);
                    $this->info('  Cover saved!');
                }
            } else {
                $this->warn('  No cover found on Wikipedia.');
            }
        }

        $this->info('Done.');
    }

    private function fetchFromWikipedia(string $title): ?string
    {
        $searchQuery = urlencode($title.' (video game)');

        $response = Http::timeout(10)->get('https://en.wikipedia.org/w/api.php', [
            'action' => 'query',
            'titles' => $searchQuery,
            'prop' => 'pageimages',
            'pithumbsize' => 600,
            'format' => 'json',
            'redirects' => 1,
        ]);

        if ($response->failed()) {
            return null;
        }

        $pages = $response->json('query.pages');

        if (! $pages) {
            return null;
        }

        $page = reset($pages);

        return $page['thumbnail']['source'] ?? null;
    }
}
