<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        $title = fake()->unique()->sentence(4);

        return [
            'title' => $title,
            'slug' => str()->slug($title),
            'content' => fake()->paragraphs(5, true),
            'image_path' => null,
            'game_id' => null,
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ];
    }
}
