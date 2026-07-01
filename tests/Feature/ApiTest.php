<?php

namespace Tests\Feature;

use App\Models\Game;
use App\Models\GameGenre;
use App\Models\News;
use App\Models\Platform;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    private Game $game;

    protected function setUp(): void
    {
        parent::setUp();

        $genre = GameGenre::factory()->create(['name' => 'Action']);
        $platform = Platform::factory()->create(['name' => 'PC']);

        $this->game = Game::factory()->create([
            'title' => 'Test Game',
            'slug' => 'test-game',
            'genre_id' => $genre->id,
            'price' => 59.99,
        ]);

        $this->game->platforms()->attach($platform->id);

        News::factory()->create([
            'title' => 'Test News',
            'slug' => 'test-news',
            'game_id' => $this->game->id,
        ]);
    }

    public function test_can_list_games(): void
    {
        $response = $this->getJson('/api/games');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'slug', 'price', 'genre', 'platforms'],
                ],
            ]);
    }

    public function test_can_show_single_game(): void
    {
        $response = $this->getJson('/api/games/test-game');

        $response->assertStatus(200)
            ->assertJson([
                'id' => $this->game->id,
                'title' => 'Test Game',
                'slug' => 'test-game',
            ])
            ->assertJsonStructure(['id', 'title', 'slug', 'genre', 'platforms', 'news']);
    }

    public function test_returns_404_for_nonexistent_game(): void
    {
        $response = $this->getJson('/api/games/nonexistent-game');

        $response->assertStatus(404);
    }

    public function test_can_list_genres(): void
    {
        $response = $this->getJson('/api/genres');

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Action']);
    }

    public function test_can_list_platforms(): void
    {
        $response = $this->getJson('/api/platforms');

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'PC']);
    }

    public function test_can_list_news(): void
    {
        $response = $this->getJson('/api/news');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'title', 'slug', 'game'],
                ],
            ]);
    }

    public function test_can_show_single_news(): void
    {
        $response = $this->getJson('/api/news/test-news');

        $response->assertStatus(200)
            ->assertJson([
                'title' => 'Test News',
                'slug' => 'test-news',
            ]);
    }

    public function test_games_pagination(): void
    {
        Game::factory(20)->create(['genre_id' => $this->game->genre_id]);

        $response = $this->getJson('/api/games');

        $response->assertStatus(200);
        $this->assertCount(12, $response->json('data'));
    }
}
